<?php

// FETCHING USER DATA FROM DATABASE - BEGINS

$item_tpl = bo3::mdl_load("templates-e/home/item.tpl");

$newsletters = new newsletter();

$newsletter_list = $newsletters->returnAllRegistries();
if (count($newsletter_list) != 0) {
	foreach ($newsletter_list as $newsletter) {
		if (!isset($list)) {
			$list = "";
		}

		if($newsletter->active == "0") {
			$active = "hidden-xs hidden-sm hidden-md hidden-lg";
			$non_active = "";
		} else {
			$active = "";
			$non_active = "hidden-xs hidden-sm hidden-md hidden-lg";
		}

		$list .= bo3::c2r(
			[
				"id" => $newsletter->id,
				"email" => $newsletter->email,
				"name" => $newsletter->name,
				"company" => $newsletter->company,
				"areas" => $newsletter->areas,
				"code" => $newsletter->code,
				"active" => $newsletter->active,
				"date" => $newsletter->date,
				"enabled" => $active,
				"non-enabled" => $non_active,
			],
			$item_tpl
		);
	}
}

/*----------------------------------------------------- FETCHING USER DATA FROM DATABASE - ENDS	 -----------------------------------------------------*/

$mdl = bo3::c2r(
	[
		"lg-export-btn" => $mdl_lang["list"]["export-btn"],
		"lg-email-title" => $mdl_lang["list"]["email-title"],
		"lg-name-title" => $mdl_lang["list"]["name-title"],
		"lg-company-title" => $mdl_lang["list"]["company-title"],
		"lg-areas-title" => $mdl_lang["list"]["areas-title"],
		"lg-code-title" => $mdl_lang["list"]["code-title"],
		"lg-active-title" => $mdl_lang["list"]["active-title"],
		"lg-date-title" => $mdl_lang["list"]["date-title"],
		"home-list" => (isset($list)) ? $list : "",
		"lg-edit" => $mdl_lang["list"]["edit"]
	],
	bo3::mdl_load("templates/home.tpl")
);

include "pages/module-core.php";
