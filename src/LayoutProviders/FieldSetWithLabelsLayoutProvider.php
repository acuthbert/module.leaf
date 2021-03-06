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

namespace Rhubarb\Leaf\LayoutProviders;

require_once __DIR__ . '/LayoutProvider.php';

use Rhubarb\Leaf\Presenters\Presenter;

class FieldSetWithLabelsLayoutProvider extends LayoutProvider
{

    /**
     * Prints the layout surrounded by a container with a title or legend.
     *
     * @param string $containerTitle
     * @param mixed[] $items
     */
    public function printItemsWithContainer($containerTitle, $items = null)
    {
        $cssClass = "-horizontal";

        if ($containerTitle != "") {
            $cssClass .= " -has-legend";
        }

        ?>
        <fieldset class="<?= $cssClass ?>">
            <?php

            if ($containerTitle != "") {
                $this->printContainerTitle($containerTitle);
            }

            $args = func_get_args();
            $args = array_slice($args, 1);

            call_user_func_array(array($this, "printItems"), $args);

            ?>
        </fieldset>
    <?php
    }


    public function printContainerTitle($containerTitle)
    {
        print '<legend class="form-legend">' . $containerTitle . '</legend>';
    }

    /**
     * Prints an array of label to value pairs.
     *
     * @param $pairs
     */
    public function printLabelValuePairs($pairs)
    {
        $registeredInputs = array();

        foreach ($pairs as $key => $value) {
            $label = "";
            $control = null;

            if (is_string($key)) {
                if (is_string($value)) {
                    $fieldName = $value;
                    $label = $key;

                    $control = $this->generateValue($fieldName);
                } else {
                    $control = $value;
                    $label = $key;
                }
            } else {
                $fieldName = $value;

                if (is_object($value)) {
                    $control = $value;
                } else {
                    $control = $this->generateValue($fieldName);
                }

                if (is_string($control)) {
                    $label = sizeof($registeredInputs);
                } else {
                    if (method_exists($control, "GetLabel")) {
                        $label = $control->getLabel();
                    }
                }
            }

            $registeredInputs[$label] = $control;
        }

        foreach ($registeredInputs as $label => $control) {
            if (is_numeric($label)) {
                $label = "&nbsp;";
            }

            $this->printValueWithLabel($control, $label);
        }
    }

    /**
     * Prints a single item
     *
     * @param $value
     * @param $label
     */
    public function printValueWithLabel($value, $label)
    {
        $controlName = (is_object($value) && ($value instanceof Presenter)) ? $value->getDisplayIdentifier() : "";

        ?>
        <div class="_group">
            <label class="_label" for="<?= $controlName; ?>"><?php $this->printLabel($label);?></label>

            <div class="_fields">

                <?php

                $this->printValue($value);

                if (is_object($value)) {
                    if ($value instanceof Presenter) {
                        $placeholder = $this->generatePlaceholder($value->getName());

                        if ($placeholder) {
                            print $placeholder;
                        }
                    }
                }

                ?>
            </div>
        </div>
    <?php
    }

    /**
     * Prints the content of a label for an item
     *
     * @param $label
     */
    public function printLabel($label)
    {
        print $label;
    }

    /**
     * Prints the value or presenter
     *
     * @param $value
     */
    public function printValue($value)
    {
        print $value;
    }
}