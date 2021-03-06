<?php

namespace Rhubarb\Leaf\UnitTesting\Presenters\Cruds;

use Rhubarb\Leaf\Views\HtmlView;
use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;

class CrudsCollectionPresenter extends ModelFormPresenter
{
	protected function CreateView()
	{
		return new HtmlView();
	}
}