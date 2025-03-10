<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['General', 'Payments', 'Refund', 'Support'];
        //
        $data = [
            'General' => [
                'How do I add a new book to the system?' =>
                    'To add a new book, go to the "Books" section in the admin panel, click "Add New," fill in the required details like title, author, semester, and branch, then upload the book file if applicable.',

                'How do I manage branches and semesters?' =>
                    'Navigate to the "Branches & Semesters" section in the admin panel. Here, you can add, edit, or delete branches and semesters as needed.',

                'How do I edit or remove an existing book?' =>
                    'Find the book in the "Books" section, click "Edit" to update details, or click "Delete" to remove it permanently from the system.',

                'Can students preview books before downloading?' =>
                    'Yes, you can enable book previews by uploading a sample file or allowing a limited preview of the book cover page in the books section.',
            ],

            'Payments' => [
                'What payment methods are supported?' =>
                    'The system supports payments via credit/debit cards, UPI, and Rajorpay. You can configure payment system in the admin settings.',

                'How do I verify if a payment was successful?' =>
                    'Go to the "Transactions" section in the admin panel. Successful payments will have a "Completed" status, while failed ones will show an error message.',

                'How do I set prices for books?' =>
                    'Book prices can be set when adding or editing a book. You can also create discount codes in the "Promotions" section.',

                'Is there an option for free downloads?' =>
                    'Yes, you can mark a book as "Free" while adding or editing it. Free books will not require a payment before downloading.',
            ],

            'Refunds' => [
                'How do I process a refund?' =>
                    'Go to the "Transactions" section, select the order, and click "Refund." The system will process the refund based on the payment method used.',

                'What is the refund policy for book purchases?' =>
                    'The refund policy can be set in the admin settings. Generally, refunds are only allowed within 7 days if the book is unreadable or incorrect.',

                'How do I check refund requests from students?' =>
                    'You can see refund requests in the "Refund Requests" section. Approve or reject them based on the provided reason.',

                'How long does it take for a refund to be processed?' =>
                    'Refunds usually take 5-7 business days to reflect in the customer’s account, depending on the payment method.',
            ],

            'Support' => [
                'How can students contact support?' =>
                    'Students can submit a support ticket via the "Help & Support" section. Admins can manage these tickets from the "Support Requests" panel.',

                'How do I respond to student inquiries?' =>
                    'Navigate to "Support Requests," view the inquiry details, and respond via email or the built-in messaging system.',

                'How do I reset a student’s password?' =>
                    'Admins can reset student passwords from the "Users" section. Select the user, click "Reset Password," and provide a temporary password.',

                'What if a student faces download issues?' =>
                    'Check the transaction status first. If the payment was successful but the download failed, manually send the book file or reset the download link.',
            ],
        ];

        foreach($data as $category => $elements){
            $index = 0;
            foreach($elements as $question => $answer){
                Faq::create([
                    'category' => $category,
                    'question' => $question,
                    'answer' => $answer,
                    'order' => ++$index,
                ]);
            }
        }

    }
}
