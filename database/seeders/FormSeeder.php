<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Contact Form
        $contactForm = Form::create([
            'title' => 'Contact Form',
            'method' => 'POST',
            'action' => '/contact',
            'configuration' => [
                'success_message' => 'Thank you for your message! We will get back to you soon.',
                'error_message' => 'There was an error sending your message. Please try again.',
            ],
            'is_active' => true,
        ]);

        // Add fields to Contact Form
        $contactForm->fields()->createMany([
            [
                'type' => 'text',
                'name' => 'name',
                'label' => 'Full Name',
                'placeholder' => 'Enter your full name',
                'required' => true,
                'validation_rules' => [
                    'min' => 2,
                    'max' => 100,
                ],
                'order' => 1,
            ],
            [
                'type' => 'email',
                'name' => 'email',
                'label' => 'Email Address',
                'placeholder' => 'Enter your email address',
                'required' => true,
                'validation_rules' => [
                    'email' => true,
                ],
                'order' => 2,
            ],
            [
                'type' => 'textarea',
                'name' => 'message',
                'label' => 'Message',
                'placeholder' => 'Enter your message',
                'required' => true,
                'validation_rules' => [
                    'min' => 10,
                    'max' => 1000,
                ],
                'order' => 3,
            ],
        ]);

        // Create Registration Form
        $registrationForm = Form::create([
            'title' => 'Registration Form',
            'method' => 'POST',
            'action' => '/register',
            'configuration' => [
                'success_message' => 'Registration successful! Welcome to our platform.',
                'error_message' => 'There was an error during registration. Please try again.',
            ],
            'is_active' => true,
        ]);

        // Add fields to Registration Form
        $registrationForm->fields()->createMany([
            [
                'type' => 'text',
                'name' => 'username',
                'label' => 'Username',
                'placeholder' => 'Choose a username',
                'required' => true,
                'validation_rules' => [
                    'min' => 3,
                    'max' => 50,
                    'unique' => 'users,username',
                ],
                'order' => 1,
            ],
            [
                'type' => 'email',
                'name' => 'email',
                'label' => 'Email Address',
                'placeholder' => 'Enter your email address',
                'required' => true,
                'validation_rules' => [
                    'email' => true,
                    'unique' => 'users,email',
                ],
                'order' => 2,
            ],
            [
                'type' => 'text',
                'name' => 'password',
                'label' => 'Password',
                'placeholder' => 'Choose a password',
                'required' => true,
                'validation_rules' => [
                    'min' => 8,
                    'confirmed' => true,
                ],
                'order' => 3,
            ],
            [
                'type' => 'select',
                'name' => 'role',
                'label' => 'Role',
                'placeholder' => 'Select your role',
                'required' => true,
                'options' => [
                    ['label' => 'User', 'value' => 'user'],
                    ['label' => 'Admin', 'value' => 'admin'],
                ],
                'order' => 4,
            ],
        ]);

        // Create Survey Form
        $surveyForm = Form::create([
            'title' => 'Customer Satisfaction Survey',
            'method' => 'POST',
            'action' => '/survey',
            'configuration' => [
                'success_message' => 'Thank you for your feedback!',
                'error_message' => 'There was an error submitting your survey. Please try again.',
            ],
            'is_active' => true,
        ]);

        // Add fields to Survey Form
        $surveyForm->fields()->createMany([
            [
                'type' => 'radio',
                'name' => 'satisfaction',
                'label' => 'How satisfied are you with our service?',
                'required' => true,
                'options' => [
                    ['label' => 'Very Satisfied', 'value' => '5'],
                    ['label' => 'Satisfied', 'value' => '4'],
                    ['label' => 'Neutral', 'value' => '3'],
                    ['label' => 'Dissatisfied', 'value' => '2'],
                    ['label' => 'Very Dissatisfied', 'value' => '1'],
                ],
                'order' => 1,
            ],
            [
                'type' => 'checkbox',
                'name' => 'features',
                'label' => 'Which features do you use most?',
                'required' => false,
                'options' => [
                    ['label' => 'Feature 1', 'value' => 'feature1'],
                    ['label' => 'Feature 2', 'value' => 'feature2'],
                    ['label' => 'Feature 3', 'value' => 'feature3'],
                ],
                'order' => 2,
            ],
            [
                'type' => 'textarea',
                'name' => 'feedback',
                'label' => 'Additional Feedback',
                'placeholder' => 'Please share your thoughts and suggestions',
                'required' => false,
                'validation_rules' => [
                    'max' => 500,
                ],
                'order' => 3,
            ],
        ]);
    }
}
