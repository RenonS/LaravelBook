<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\book;



class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;


    protected $email;
    protected $book;
    protected $name;
    protected $author;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $book, $name, $author)
    {
        $this->email = $email;
        $this->name = $name;
        $this->book = $book;
        $this->author = $author;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emailMsg')
                    ->with([
                        'email' => $this->email,
                        'name' => $this->name,
                        'bookName' => $this->book->name,
                        'bookAuthor' => $this->author->name,
                    ]);
    }
}
