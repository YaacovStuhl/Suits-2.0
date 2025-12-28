const express = require('express');
const path = require('path');
const mysql = require('mysql2/promise');
const nodemailer = require('nodemailer');

const PORT = process.env.MENU_PORT || process.env.PORT || 4000;

const dbConfig = {
  host: process.env.DB_HOST || 'localhost',
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASS || '',
  database: process.env.DB_NAME || 'simply_suits_db',
  waitForConnections: true,
  connectionLimit: 10,
  namedPlaceholders: true
};

const pool = mysql.createPool(dbConfig);

async function ensureSchema() {
  await pool.query(`
    CREATE TABLE IF NOT EXISTS node_measurements (
      id INT AUTO_INCREMENT PRIMARY KEY,
      client_name VARCHAR(100) NOT NULL,
      email VARCHAR(150) NOT NULL,
      suit_style VARCHAR(120) NOT NULL,
      jacket VARCHAR(50) NULL,
      waist VARCHAR(50) NULL,
      inseam VARCHAR(50) NULL,
      fit_notes TEXT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  `);
}

ensureSchema().catch((err) => {
  console.error('Failed to ensure Node measurement table exists', err);
});

const menuItems = [
  { key: 'home', label: 'Home', url: '/' },
  { key: 'entry', label: 'Measurement Intake', url: '/measurements' },
  { key: 'display', label: 'Showroom Data', url: '/showroom' },
  { key: 'contact', label: 'Contact Us', url: '/contact' }
];

const app = express();
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'pug');

app.use('/assets', express.static(path.join(__dirname, 'images')));
app.use(express.urlencoded({ extended: true }));
app.use(express.json());

app.use((req, res, next) => {
  res.locals.siteTitle = 'Simply Suits Node Portal';
  res.locals.menuItems = menuItems;
  res.locals.currentKey = menuItems.find((item) => item.url === req.path)?.key || null;
  res.locals.logoPath = '/assets/new-logo.png';
  next();
});

const asyncHandler =
  (handler) =>
  (req, res, next) =>
    Promise.resolve(handler(req, res, next)).catch(next);

app.get(
  '/',
  asyncHandler(async (req, res) => {
    const [[categoryStats]] = await pool.query('SELECT COUNT(*) AS total FROM categories');
    const [[userStats]] = await pool.query('SELECT COUNT(*) AS total FROM users');
    const [[measurementStats]] = await pool.query('SELECT COUNT(*) AS total FROM node_measurements');
    const [featuredCategories] = await pool.query(
      'SELECT category_name, description FROM categories ORDER BY display_order ASC LIMIT 3'
    );

    res.render('home', {
      pageTitle: 'Welcome',
      currentKey: 'home',
      stats: {
        categories: categoryStats.total,
        clients: userStats.total,
        measurements: measurementStats.total
      },
      featuredCategories
    });
  })
);

app.get(
  '/measurements',
  asyncHandler(async (req, res) => {
    res.render('measurements', {
      pageTitle: 'Measurement Intake',
      currentKey: 'entry',
      saved: req.query.saved === '1',
      formData: {}
    });
  })
);

app.post(
  '/measurements',
  asyncHandler(async (req, res) => {
    const formData = {
      client_name: req.body.client_name?.trim(),
      email: req.body.email?.trim(),
      suit_style: req.body.suit_style?.trim(),
      jacket: req.body.jacket?.trim(),
      waist: req.body.waist?.trim(),
      inseam: req.body.inseam?.trim(),
      fit_notes: req.body.fit_notes?.trim()
    };

    const errors = [];
    if (!formData.client_name) errors.push('Client name is required.');
    if (!formData.email) errors.push('Email is required.');
    if (!formData.suit_style) errors.push('Select a suit style.');

    if (errors.length) {
      return res.status(400).render('measurements', {
        pageTitle: 'Measurement Intake',
        currentKey: 'entry',
        errors,
        formData
      });
    }

    await pool.query(
      `INSERT INTO node_measurements
        (client_name, email, suit_style, jacket, waist, inseam, fit_notes)
       VALUES (:client_name, :email, :suit_style, :jacket, :waist, :inseam, :fit_notes)`,
      formData
    );

    res.redirect('/measurements?saved=1');
  })
);

app.get(
  '/showroom',
  asyncHandler(async (req, res) => {
    const [categories] = await pool.query(
      'SELECT category_name, description FROM categories ORDER BY display_order ASC'
    );
    res.render('showroom', {
      pageTitle: 'Showroom Data',
      currentKey: 'display',
      categories
    });
  })
);

let cachedMailTransport;
let cachedTestAccount;

async function getMailTransport() {
  if (cachedMailTransport && cachedTestAccount) {
    return { transporter: cachedMailTransport, account: cachedTestAccount };
  }

  const testAccount = await nodemailer.createTestAccount();
  const transporter = nodemailer.createTransport({
    host: testAccount.smtp.host,
    port: testAccount.smtp.port,
    secure: testAccount.smtp.secure,
    auth: {
      user: testAccount.user,
      pass: testAccount.pass
    }
  });

  cachedMailTransport = transporter;
  cachedTestAccount = testAccount;
  return { transporter, account: testAccount };
}

app.get(
  '/contact',
  asyncHandler(async (req, res) => {
    res.render('contact', {
      pageTitle: 'Contact Us',
      currentKey: 'contact',
      formData: {}
    });
  })
);

app.post(
  '/contact',
  asyncHandler(async (req, res) => {
    const formData = {
      name: req.body.name?.trim(),
      email: req.body.email?.trim(),
      message: req.body.message?.trim()
    };

    const errors = [];
    if (!formData.name) errors.push('Name is required.');
    if (!formData.email) errors.push('Email is required.');
    if (!formData.message) errors.push('Message cannot be empty.');

    if (errors.length) {
      return res.status(400).render('contact', {
        pageTitle: 'Contact Us',
        currentKey: 'contact',
        errors,
        formData
      });
    }

    const { transporter } = await getMailTransport();
    const info = await transporter.sendMail({
      from: '"Simply Suits Concierge" <no-reply@simplysuits.local>',
      to: 'hello@simplysuits.io',
      replyTo: formData.email,
      subject: `Node Contact Form: ${formData.name}`,
      text: formData.message
    });

    const previewUrl = nodemailer.getTestMessageUrl(info);

    res.render('contact', {
      pageTitle: 'Contact Us',
      currentKey: 'contact',
      sent: true,
      previewUrl,
      formData: {}
    });
  })
);

app.use((req, res) => {
  res.status(404).render('error', {
    pageTitle: 'Not Found',
    currentKey: null,
    message: 'The requested resource could not be located.'
  });
});

app.use((err, req, res, next) => {
  console.error('Node server error:', err);
  res.status(500).render('error', {
    pageTitle: 'Server Error',
    currentKey: null,
    message: 'An unexpected error occurred. Please try again later.'
  });
});

if (require.main === module) {
  app.listen(PORT, () => {
    console.log(`Simply Suits node server listening at http://localhost:${PORT}`);
  });
}

module.exports = app;

