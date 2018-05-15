<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Inherit from another theme
	|--------------------------------------------------------------------------
	|
	| Set up inherit from another if the file is not exists, this 
	| is work with "layouts", "partials", "views" and "widgets"
	|
	| [Notice] assets cannot inherit.
	|
	*/

	'inherit' => null, //default

	/*
	|--------------------------------------------------------------------------
	| Listener from events
	|--------------------------------------------------------------------------
	|
	| You can hook a theme when event fired on activities this is cool 
	| feature to set up a title, meta, default styles and scripts.
	|
	| [Notice] these event can be override by package config.
	|
	*/

	'events' => array(

		'before' => function($theme)
		{
//			$theme->setTitle('Title example');
//			$theme->setAuthor('Jonh Doe');
		},

		'asset' => function($asset)
		{
			$asset->themePath()->add([
										['style', ['css/style.css','css/prism.css']],
										['script', ['js/script.js','js/prism.js']]
									 ]);

            $asset->cook('cdn', function($asset)
            {
                $asset->add('jq', 'https://cdn.bootcss.com/jquery/2.0.0/jquery.min.js');
                $asset->add('pjax', 'https://cdn.bootcss.com/jquery.pjax/2.0.1/jquery.pjax.min.js');
                $asset->add('mdui', 'https://cdn.bootcss.com/mdui/0.4.0/js/mdui.min.js');
                $asset->add('mdui', 'https://cdn.bootcss.com/mdui/0.4.0/css/mdui.min.css');
                $asset->add('NProgress', 'https://unpkg.com/nprogress@0.2.0/nprogress.js');
                $asset->add('NProgress', 'https://unpkg.com/nprogress@0.2.0/nprogress.css');
                $asset->add('nanobar', 'https://cdn.bootcss.com/nanobar/0.4.2/nanobar.min.js');
                $asset->add('font', 'https://at.alicdn.com/t/font_579919_p94txrc53ciejyvi.css');
            });

             Theme::asset()->serve('cdn');
		},


		'beforeRenderTheme' => function($theme)
		{
			// To render partial composer
			/*
	        $theme->partialComposer('header', function($view){
	            $view->with('auth', Auth::user());
	        });
			*/

		},

		'beforeRenderLayout' => array(

			'mobile' => function($theme)
			{
				// $theme->asset()->themePath()->add('ipad', 'css/layouts/ipad.css');
			}

		)

	)

);