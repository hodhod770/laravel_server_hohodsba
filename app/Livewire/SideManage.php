<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sides; // Assuming you have a Side model for managing sides
class SideManage extends Component
{
    public  $name = '';
    public function render()
    {
        // Render the view for managing sides
        $data= Sides::all(); // Fetch all sides from the database
        return view('livewire.side-manage', ['sides' => $data])->layout('components.layouts.master');
        // The layout method specifies the master layout to use for this component
       
    }
    public function addSide()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        Sides::create([
            'name' => $this->name,
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
        ]);

        $this->name = ''; // Reset the input field after adding
        session()->flash('message', 'Side added successfully!');
    }
    public function deleteSide($id)
    {
        $side = Sides::find($id);
        if ($side) {
            $side->delete();
            session()->flash('message', 'Side deleted successfully!');
        } else {
            session()->flash('error', 'Side not found.');
        }
    }

}
