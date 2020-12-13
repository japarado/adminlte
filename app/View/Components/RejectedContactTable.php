<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RejectedContactTable extends Component
{
	public $rejectedContacts;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(object $rejectedContacts)
    {
		$this->rejectedContacts = $rejectedContacts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.rejected-contact-table');
    }
}
