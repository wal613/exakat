<?php
/*
 * Copyright 2012-2018 Damien Seguy – Exakat Ltd <contact(at)exakat.io>
 * This file is part of Exakat.
 *
 * Exakat is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Exakat is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Exakat.  If not, see <http://www.gnu.org/licenses/>.
 *
 * The latest code can be found at <http://exakat.io/>.
 *
*/

namespace Exakat\Analyzer\Performances;

use Exakat\Analyzer\Analyzer;

class UseBlindVar extends Analyzer {
    public function dependsOn() {
        return array('Arrays/IsModified',
                    );
    }
    
    public function analyze() {
        // foreach($a as $k => $b) { $c = $a[$k] + 2;}
        $this->atomIs('Foreach')

             ->outIs('SOURCE')
             ->savePropertyAs('fullcode', 'source')
             ->back('first')

             ->outIs('VALUE')
             ->outIs('INDEX')
             ->savePropertyAs('fullcode', 'index')
             ->back('first')
             
             ->outIs('BLOCK')
             ->atomInsideNoDefinition('Array')

             ->_as('array')
             ->analyzerIsNot('Arrays/IsModified')
             ->outIs('INDEX')
             ->samePropertyAs('fullcode', 'index')
             ->back('array')
             
             ->outIs('VARIABLE')
             ->samePropertyAs('fullcode', 'source')
             ->inIs('VARIABLE');
        $this->prepareQuery();
    }
}

?>