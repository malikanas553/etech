<?php

/*
|--------------------------------------------------------------------------
| Etech landing page content
|--------------------------------------------------------------------------
| All copy for the landing page lives here so the Blade sections only
| loop over data. Text matches the original design word for word.
*/

return [

    'brand' => 'Etech.',

    'nav' => [
        ['label' => 'Courses', 'dropdown' => ['Web Design', 'UI/UX Design', 'Data Science']],
        ['label' => 'Teachers', 'dropdown' => ['All Teachers', 'Become a Teacher']],
        ['label' => 'Offers', 'dropdown' => ['Discounts', 'Free Courses']],
        ['label' => 'Contact', 'dropdown' => null],
    ],

    'hero' => [
        'title' => 'Develop your skills in a new and unique way',
        'text' => 'Explore a transformative approach to skill development on our online learning platform. Uncover a new realm of learning experiences and elevate your expertise in unique ways.',
        'cta' => 'Enroll Now',
        'video' => "What's Etech?",
        'courses' => ['value' => '50+', 'label' => 'Online Courses'],
        'students' => ['value' => '10k+', 'label' => 'Online Students'],
        'class' => ['title' => 'UI Design Class', 'time' => 'Today at 12.00 PM', 'cta' => 'Join now'],
    ],

    'partners' => ['duolingo', 'magicleap', 'microsoft', 'codecov', 'usertesting'],

    'search' => [
        'title' => 'Search Courses',
        'placeholder' => 'Search for over 50+ courses',
        'button' => 'Search',
    ],

    'benefits' => [
        'accent' => 'Benefits',
        'title' => 'From Our Online Learning',
        'items' => [
            ['icon' => 'graduation', 'color' => 'purple', 'title' => 'Online Degrees', 'text' => 'Earn accredited degrees from the comfort of your home, opening doors to a world of possibilities.'],
            ['icon' => 'book', 'color' => 'pink', 'title' => 'Short Courses', 'text' => 'Enhance your skills with our concise and focused short courses, designed for quick and effective learning.'],
            ['icon' => 'user', 'color' => 'purple', 'title' => 'Training From Experts', 'text' => 'Immerse yourself in knowledge with industry experts guiding you through hands-on experience.'],
            ['icon' => 'play', 'color' => 'pink', 'title' => '1.5k+ Video Courses', 'text' => 'Dive into a vast library of over 1.5k video courses covering many subjects, offering a visual learning experience.'],
        ],
    ],

    'courses' => [
        'title' => 'Our Popular Courses',
        'text' => "Discover our most sought-after courses, carefully curated to meet the demands of today's learners. Dive into engaging content crafted for success in every step of your educational journey.",
        'items' => [
            ['image' => 'course-web', 'tag' => 'Web Design', 'rating' => '4.8', 'title' => 'Web Design & Development', 'classes' => 25, 'students' => 135, 'price' => '$560.00', 'teacher' => 'J. Morgan', 'avatar' => 'avatar-3'],
            ['image' => 'course-uiux', 'tag' => 'UI/UX Design', 'rating' => '5.0', 'title' => 'Wireframing & Prototyping', 'classes' => 8, 'students' => 400, 'price' => '$160.00', 'teacher' => 'Jordan Re', 'avatar' => 'avatar-4'],
            ['image' => 'course-python', 'tag' => 'Data Science', 'rating' => '4.9', 'title' => 'Python For Data Science', 'classes' => 18, 'students' => 150, 'price' => '$432.00', 'teacher' => 'Alex Taylor', 'avatar' => 'avatar-6'],
        ],
    ],

    'instructor' => [
        'title' => 'If You Are A Certified Teacher Then',
        'accent' => 'Become An Instructor',
        'text' => "Unlock the opportunity to inspire and educate by joining our team of instructors. If you're a certified teacher, elevate your impact and share your expertise with learners worldwide.",
        'perks_title' => 'Enjoy Many Perks',
        'perks' => [
            'Global Impact', 'Flexible Schedule', 'Innovative Teaching Tools', 'Recognition And Reputation',
            'Creative Freedom', 'Monetize Your Expertise', 'Professional Development', 'Networking Opportunities',
        ],
        'cta' => 'Become an Instructor',
    ],

    'testimonials' => [
        'title' => "Student's Testimonials",
        'text' => "Here's what our students have to say about their transformative learning experience: Real stories, real growth. Discover firsthand the impact our courses have had on their lives.",
        'total' => 15,
        'items' => [
            ['name' => 'Alexa Rodriguez', 'role' => 'Web Developer', 'avatar' => 'avatar-1', 'quote' => 'Enrolling in courses at this eLearning platform was a game-changer for me. Absolutely transformative experience!'],
            ['name' => 'Emily Chen', 'role' => 'UI/UX Designer', 'avatar' => 'avatar-5', 'quote' => 'Exceptional courses! The practical insights and flexible learning structure have been instrumental in my professional growth.'],
            ['name' => 'James Johnson', 'role' => 'Data Scientist', 'avatar' => 'avatar-3', 'quote' => 'Highly recommend! The personalized feedback and real-world application in the courses have elevated my understanding of the subject.'],
            ['name' => 'Sophia Martinez', 'role' => 'Product Manager', 'avatar' => 'avatar-2', 'quote' => 'The instructors are amazing and the community is so supportive. I landed my dream role after finishing two courses.'],
            ['name' => 'Daniel Kim', 'role' => 'Frontend Engineer', 'avatar' => 'avatar-4', 'quote' => 'Clear lessons, real projects and great pacing. It is the best investment I have made in my career so far.'],
            ['name' => 'Olivia Brown', 'role' => 'Graphic Designer', 'avatar' => 'avatar-6', 'quote' => 'I loved how flexible everything was. I could learn at my own pace and still feel guided every step of the way.'],
        ],
    ],

    'subscribe' => [
        'title' => 'Get In Touch!',
        'text' => 'Subscribe Us to get in touch and to enjoy discounts, promos and much more!',
        'placeholder' => 'Enter your email...',
        'button' => 'Subscribe',
    ],

    'footer' => [
        'about' => 'Explore a transformative approach to skill development on our online learning platform.',
        'columns' => [
            'Company' => ['About Us', 'Services', 'Community', 'Testimonials'],
            'Support' => ['Help Center', 'Tweet @ Us', 'Webinars', 'Feedback'],
            'Links' => ['Courses', 'Become Teacher', 'Service', 'All in One'],
        ],
        'phone' => '+1 (555) 123-4567',
        'email' => 'etechinfo@gmail.com',
        'copyright' => 'Copyright © 2023 Etech. All rights reserved',
    ],

];
