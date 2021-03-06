<?php

/*
 *	Copyright 2015 RhubarbPHP
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

namespace Rhubarb\Leaf\LayoutProviders\Flexi;

require_once __DIR__ . '/../PrintableList.php';
require_once __DIR__ . '/../PrintsContainer.php';

use Rhubarb\Leaf\LayoutProviders\PrintableList;
use Rhubarb\Leaf\LayoutProviders\PrintsContainer;

class InlineList extends PrintableList implements PrintsContainer
{
    function __toString()
    {
        $content = parent::__toString();

        return "<div class=\"field field--inline\">" . $content . "</div>";
    }
}