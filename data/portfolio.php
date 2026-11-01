<?php
// All portfolio content lives here. Add a new project = copy one block and edit.
return [
    'stats' => [
        ['value' => 200, 'suffix' => 'K+', 'label' => 'App downloads on Google Play'],
        ['value' => 7,   'suffix' => '',   'label' => 'Live Play Store apps'],
        ['value' => 5,   'suffix' => '',   'label' => 'Live websites & portals'],
        ['value' => 8,   'suffix' => '+',  'label' => 'HTML5 learning games'],
    ],

    'services' => [
        ['icon' => 'globe',   'title' => 'Website Development',     'text' => 'Fast, mobile-first business, school and personal websites that rank on Google and turn visitors into enquiries.'],
        ['icon' => 'news',    'title' => 'News & Content Portals',  'text' => 'Marathi/English news portals with categories, video news, e-magazine and an easy admin panel for daily posting.'],
        ['icon' => 'school',  'title' => 'Education Platforms',     'text' => 'Coaching institute sites, online courses, test series, results and student login. Built by a teacher who knows classrooms.'],
        ['icon' => 'android', 'title' => 'Android App Development', 'text' => 'Published Android apps with 200K+ downloads. Learning apps, quiz apps and business apps, ready for the Play Store.'],
        ['icon' => 'game',    'title' => 'Educational Games',       'text' => 'Interactive HTML5 games for kids: maths, alphabets, board games and science, playable on any phone or smart board.'],
        ['icon' => 'rocket',  'title' => 'Domain, Hosting & SEO',   'text' => 'Domain setup, hosting, SSL, Google Search Console and speed optimisation. Your site live and found, without the headache.'],
    ],

    // type: web | app | game
    'projects' => [
        [
            'type' => 'web', 'featured' => true,
            'title' => 'Kranti WAVE: Marathi News Portal',
            'client' => 'krantiwave.in',
            'image' => 'assets/img/work/krantiwave.jpg',
            'url' => 'https://krantiwave.in/',
            'summary' => 'A full Marathi digital news portal: breaking news, video news, features, jobs, agriculture, graphics carousel and the "Krantiagrani Parva" fortnightly e-magazine.',
            'tags' => ['News Portal', 'Marathi', 'CMS', 'SEO'],
        ],
        [
            'type' => 'web', 'featured' => true,
            'title' => 'Vijeta Academy Sangli',
            'client' => 'vijetaacademysangli.in',
            'image' => 'assets/img/work/vijeta.jpg',
            'url' => 'https://vijetaacademysangli.in/',
            'summary' => 'Coaching institute website with course catalogue (Scholarship 4th & 7th, MAHA TET, Pradnyashodh), pricing, exams, results and an online learning platform.',
            'tags' => ['Education', 'Courses', 'Online Platform'],
        ],
        [
            'type' => 'web', 'featured' => true,
            'title' => 'DiGi School Sangli',
            'client' => 'digischoolsangli.com',
            'image' => 'assets/img/work/digischool.jpg',
            'url' => 'https://digischoolsangli.com/',
            'summary' => 'Digital library for students of Zilla Parishad Sangli: pre-primary to secondary content, competitive exams, arts & sports, teacher and parent corners, with login/registration.',
            'tags' => ['Digital Library', 'Government', 'LMS'],
        ],
        [
            'type' => 'web',
            'title' => 'Techedu.in: Learning Portal',
            'client' => 'techedu.in',
            'image' => 'assets/img/work/techeduin.jpg',
            'url' => 'https://techedu.in/',
            'summary' => 'My own educational portal ("School, Family & Community"): Marathi learning resources, blog, interactive games and the home of my Android apps.',
            'tags' => ['Portal', 'Blog', 'Games'],
        ],

        // ---- Android apps ----
        ['type' => 'app', 'featured' => true, 'title' => 'Navodaya Entrance Exam (नवोदय)', 'image' => 'assets/apps/com.techedu.navoday.png', 'url' => 'https://play.google.com/store/apps/details?id=com.techedu.navoday', 'summary' => 'Practice app for Class 5 students preparing for the Jawahar Navodaya Vidyalaya Selection Test.', 'tags' => ['100K+ downloads', 'Exam Prep'], 'downloads' => '100K+'],
        ['type' => 'app', 'featured' => true, 'title' => 'Marathi Kids First School (बाराखडी)', 'image' => 'assets/apps/techedu.kids.com.png', 'url' => 'https://play.google.com/store/apps/details?id=techedu.kids.com', 'summary' => 'The easy way for kids and first-time learners to learn Marathi letters with trace & learn.', 'tags' => ['100K+ downloads', 'Kids'], 'downloads' => '100K+', 'rating' => '4.0'],
        ['type' => 'app', 'title' => 'Kids Math: Add, Subtract, Multiply, Divide', 'image' => 'assets/apps/com.techedu.maths.png', 'url' => 'https://play.google.com/store/apps/details?id=com.techedu.maths', 'summary' => 'Practise the four maths operations with fun, level-based drills.', 'tags' => ['Maths', 'Kids'], 'downloads' => '5K+', 'rating' => '3.8'],
        ['type' => 'app', 'title' => 'Kids Learning Activity', 'image' => 'assets/apps/com.techedu.kidslearning.png', 'url' => 'https://play.google.com/store/apps/details?id=com.techedu.kidslearning', 'summary' => 'ABC tracing and phonics activities for preschool kids.', 'tags' => ['Phonics', 'Preschool'], 'downloads' => '1K+', 'rating' => '4.8'],
        ['type' => 'app', 'title' => 'Kids Computer Preschool', 'image' => 'assets/apps/com.techedu.kidscomputer.png', 'url' => 'https://play.google.com/store/apps/details?id=com.techedu.kidscomputer', 'summary' => 'Teach children alphabets, numbers and colours on a playful kid-computer.', 'tags' => ['Preschool'], 'downloads' => '1K+', 'rating' => '4.1'],
        ['type' => 'app', 'title' => 'Khajana: General Science (खजाना)', 'image' => 'assets/apps/com.techedu.khajana.png', 'url' => 'https://play.google.com/store/apps/details?id=com.techedu.khajana', 'summary' => '"Did you know?" General science app full of interesting facts in Marathi.', 'tags' => ['Science', 'Marathi'], 'downloads' => '1K+'],
        ['type' => 'app', 'title' => 'Trace And Learn Alphabet', 'image' => 'assets/apps/com.techedu.traceNlearn.png', 'url' => 'https://play.google.com/store/apps/details?id=com.techedu.traceNlearn', 'summary' => 'Beautiful graphics and easy tracing to learn the English alphabet.', 'tags' => ['Alphabet', 'Kids'], 'downloads' => '500+'],

        // ---- Web games (techedu.in) ----
        ['type' => 'game', 'title' => 'Maths Fun Train Builder', 'image' => 'assets/img/work/game-0.jpg', 'url' => 'https://games.techedu.in/mathsfun/', 'summary' => 'Build the train by solving maths problems.', 'tags' => ['Maths', 'HTML5']],
        ['type' => 'game', 'title' => 'Kids Ludo Board Game', 'image' => 'assets/img/work/game-2.jpg', 'url' => 'https://games.techedu.in/boardgame/', 'summary' => 'Classic dice board game for young learners.', 'tags' => ['Board Game']],
        ['type' => 'game', 'title' => 'Kids Hindi Alphabets', 'image' => 'assets/img/work/game-3.jpg', 'url' => 'https://games.techedu.in/hindialpha/', 'summary' => 'Interactive Hindi varnamala for kids.', 'tags' => ['Hindi', 'Language']],
        ['type' => 'game', 'title' => 'सापशिडी (Snakes & Ladders)', 'image' => 'assets/img/work/game-4.jpg', 'url' => 'https://games.techedu.in/sapshidi/', 'summary' => 'Educational snakes & ladders in Marathi.', 'tags' => ['Marathi', 'Board Game']],
        ['type' => 'game', 'title' => 'Organ System', 'image' => 'assets/img/work/game-5.jpg', 'url' => 'https://games.techedu.in/organsystem/', 'summary' => 'Drag-and-drop game on the human organ systems.', 'tags' => ['Science']],
        ['type' => 'game', 'title' => 'Words Matching Game', 'image' => 'assets/img/work/game-6.jpg', 'url' => 'https://games.techedu.in/matching/', 'summary' => 'Match words and pictures to build vocabulary.', 'tags' => ['English', 'Vocabulary']],
        ['type' => 'game', 'title' => 'Math is Fun', 'image' => 'assets/img/work/game-7.jpg', 'url' => 'https://games.techedu.in/funmath/', 'summary' => 'Quick-fire arithmetic challenges.', 'tags' => ['Maths']],
        ['type' => 'game', 'title' => 'कचरा व्यवस्थापन (Waste Sorting)', 'image' => 'assets/img/work/game-8.jpg', 'url' => 'https://games.techedu.in/Waste/', 'summary' => 'Sort the waste correctly and learn about cleanliness.', 'tags' => ['EVS', 'Marathi']],
    ],

    'process' => [
        ['title' => 'Discuss', 'text' => 'Free call or WhatsApp chat to understand your business, audience and budget.'],
        ['title' => 'Design',  'text' => 'A clean layout and content plan, shared with you for approval before coding.'],
        ['title' => 'Develop', 'text' => 'Fast, secure, mobile-first build with an admin panel so you can update it yourself.'],
        ['title' => 'Launch & Support', 'text' => 'Domain, hosting, SSL and Google setup, plus support after go-live.'],
    ],

    // Indicative starting prices. Edit freely or set 'show_pricing' => false in index.php.
    'pricing' => [
        ['name' => 'Starter Website', 'price' => '₹4,999', 'note' => 'one-time', 'features' => ['Up to 5 pages', 'Mobile responsive', 'Contact + WhatsApp button', 'Google Maps & basic SEO', 'Free SSL setup'], 'highlight' => false],
        ['name' => 'Business / Institute', 'price' => '₹14,999', 'note' => 'one-time', 'features' => ['Up to 15 pages + blog/news', 'Admin panel to post updates', 'Courses, gallery, results', 'Speed & SEO optimisation', '3 months free support'], 'highlight' => true],
        ['name' => 'App or Custom Portal', 'price' => 'Custom', 'note' => 'get a quote', 'features' => ['Android app (Play Store)', 'Student/teacher logins', 'Tests, payments, dashboards', 'Educational games', 'Maintenance plans'], 'highlight' => false],
    ],

    'faq' => [
        ['q' => 'How long does a website take?', 'a' => 'A starter website is usually ready in 5–7 days. Portals and apps take 2–6 weeks depending on features.'],
        ['q' => 'Can I update the content myself?', 'a' => 'Yes. Business and portal sites come with a simple admin panel, and I give you a short training session.'],
        ['q' => 'Do you provide domain and hosting?', 'a' => 'Yes. I can register the domain and set up reliable hosting, or work with the hosting you already have.'],
        ['q' => 'Do you build Marathi websites?', 'a' => 'Absolutely. Most of my work is in Marathi, English or both, with proper Devanagari fonts and SEO.'],
    ],
];
