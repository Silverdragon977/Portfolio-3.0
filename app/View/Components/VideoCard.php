<?php
//  app/View/Components/VideoCard.php 
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VideoCard extends Component
{
    /**
     * Create a new component instance.
     */
    public string $videoName;
    public ?string $caption;
    public string $side;
    public string $heading;

    public function __construct(string $videoName, ?string $caption = null, string $side = 'left', string $heading = '')
    {
        $this->videoName = $videoName;
        $this->caption = $caption;
        $this->side = $side;
        $this->heading = $heading;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.video-card');
    }
}
