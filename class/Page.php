<?php

class Page {
    public string $defaultTwoLayout = "vertical";
    public string $defaultThreeLayout = "1-2";

    public string $pageName;

    // Whether this page should be included in the slideshow or not
    // KEEP IN MIND THAT THIS IS A STRING "true" OR "false"
    // FOR SOME STUPID REASON BOOLS WOULDNT WORK PROPERLY WITH SAVING
    public string $visible;

    // Amount of widgets
    public int $amount;

    // Array with widget names (as strings)
    public Array $widgets;

    // 2-layout: "horizontal" (default) or "vertical"
    public string $twoLayout;

    // 3-layout: "2-1" (default) or "1-2"
    public string $threeLayout;

    /**
     * @return string The layout used for this page (which also includes the amount)
     */
    function getLayoutAsString() : string {
        if ($this->amount == 1) return "1";

        else if ($this->amount == 2) {
            if ($this->twoLayout == "horizontal") {
                return "2-horizontal";
            }
            else if ($this->twoLayout == "vertical") {
                return "2-vertical";
            }
        }

        else if ($this->amount == 3) {
            return $this->threeLayout;
        }

        else return "4";
    }
}

?>