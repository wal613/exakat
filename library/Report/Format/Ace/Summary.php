<?php

namespace Report\Format\Ace;

class Summary extends \Report\Format\Ace { 
    public function render($output, $data) {
        $text = $this->render2($data);

        $text = <<<TEXT
$text

TEXT;

        $output->push($text);
    }

    private function render2($data) {
        $text = '';
        foreach($data as $row) {
            if (get_class($row) != "Report\\Template\\Section") { continue; }
            if ($row->getName() == "Summary") { continue; }
            $text .= <<<HTML
					<li>
							<span class="menu-text"> {$row->getName()} </span>
					</li>
HTML;
        }
        
        return "<p><ul>$text</ul></p>"; 
    }
}

?>