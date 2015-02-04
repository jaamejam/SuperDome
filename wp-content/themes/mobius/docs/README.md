
#Mobius WordPress Theme

##About

**Theme Information**: [simplethemes.com/wordpress-themes/theme/mobius](http://www.simplethemes.com/wordpress-themes/theme/mobius "Mobius WordPress Theme Info")

**Live Demo**: [simplethemes.com/wordpress-themes/demo/mobius](http://www.simplethemes.com/wordpress-themes/demo/mobius "Mobius WordPress Theme Demo")

**Changelog**: [simplethemes.com/wordpress-themes/changelog/mobius](http://www.simplethemes.com/wordpress-themes/changelog/mobius "Mobius WordPress Theme Changelog")



## Installation & Basic Setup

####Updates

Mobius may be used as a standalone theme or as a __parent theme__ alongside of a __child theme__ (included in your download).  

If you choose to use Mobius as-is, automatic updates will be disabled. This is to ensure that you do not lose any of your customizations. If you do, however plan on making customizations to the CSS, we recommend setting up Mobius as a __parent theme__.

To do this, install the sample __mobius-child__ theme included in your download package. Set the Preset Style to "Child Theme" mode and follow the instructions in the child theme style.css file. See the accompanying functions.php file for advanced layout customizations.


###Formatting Tips
WordPress has its fair share of quirks. If you find that WordPress auto paragraph formatting (wpautop) is getting in the way of your markup, simply add a custom field to your Page or Post named "wpautop" with a value of "false".

###Page Titles
Mobius has a Designer Page template which will hide the Page title and sidebar. If you want to just hide the title of a Page or Post, simply create a custom field named "hidetitle" and set the value to "true".

##Shortcodes

Mobius has several built in shortcodes. You can see them in action on the [shortcodes demo page](http://demos.simplethemes.com/mobius/features/useful-shortcodes).


###Callouts

A callout is (by default) a rounded cornered styled inset box. It has two arguments:

* **align** - aligns the callout left, right, or center
* **width** - Only use this parameter if you must. Defined widths will not scale properly on all devices. Instead, consider embedding them in one of the column shortcodes.

<!---->

	[callout align="center" width="400"]
	This is a 400px centered callout box
	[/callout]
	
	[callout align="left" width="200"]
	This is a 200px left aligned callout box
	[/callout]
	
	[callout align="right" width="100"]
	This is a 100px right aligned callout box
	[/callout]
	
	[callout]
	This is a callout that will expand the entire width of its parent container.
	[/callout]

----

###Fluid Columns

You've seen these before. The fractional shortcode combinations allow you to insert scalable columns into your content. The only rule here is, the last column must have a suffix of '_last'. See the example below.

	// Three Columns Example
	[one_third]
	Column One - Add anything you want here
	[/one_third]
	
	[one_third]
	Column Two - Add anything you want here
	[/one_third]
	
	[one_third_last]
	Column Three - Add anything you want here
	[/one_third_last]
	
Available Options – Up to 6 columns

* one_third
* two_thirds
* one_half
* one_fourth
* three_fourths
* one_fifth
* two_fifth
* three_fifth
* four_fifth
* one_sixth
* five_sixth

----

###Cross-Browser CSS3 Buttons
Tested in IE7,IE8,IE9,Webkit, and Mozilla browsers.
[Preview all colors and sizes](http://demos.simplethemes.com/mobius/button-styles)

	[button align="center" color="white" size="small" link="http://www.simplethemes.com"]Small Button[/button]

----

###Tabs
You can create tabs content within your content as well. Each tab needs a unique id (identifier) in order to work.

	[tabgroup]
	[tab title="Tab 1" id="t1"]Tab 1 content[/tab]
	[tab title="Tab 2" id="t2"]Tab 2 content[/tab]
	[tab title="Tab 3" id="t3"]Tab 3 content[/tab]
	[/tabgroup]

----

###Accordion Toggles
[See them in action here.](http://demos.simplethemes.com/smpl/documentation#gist-1142632)

	[toggle title="Button text One"]
	Toggle Content One
	[/toggle]
	
	[toggle title="Button Text Two"]
	Toggle Content Two
	[/toggle]
	
	[toggle title="Button Text Three"]
	Toggle Content Three
	[/toggle]

----

###Lightbox

Inserts a lightbox image or video link.

Parameters:

 * href // URL to load
 * height // numeric
 * width // numeric
 * iframe // boolean

#####Simple Image Example:

	[lightbox href="http://www.yourdomain.com/path/to/img.jpg" title="My Image"]Image[/lightbox]

#####Simple YouTube Example

	[lightbox href="http://www.youtube.com/watch?v=oHg5SJYRHA0" width="640" height="480" title="YouTube"]Video[/lightbox]

#####YouTube (API) Example
	[lightbox href="http://www.youtube.com/embed/oHg5SJYRHA0?hd=1&controls=0&autoplay=1" iframe="true" width="710" height="400" title="YouTube"]YouTube API Example[/lightbox]
[YouTube API](http://code.google.com/apis/youtube/player_parameters.html)


----

###Latest Posts

Insert a list of your latest posts from specified category(s) into any page with optional thumbnail and excerpt.

	[latest excerpt="true" thumbs="true" width="50" height="50" num="5" cat="8,10,11"]
	
----

###Related Posts

Insert a list of related (tagged) posts.

	[related_posts]

----

###Clearing

If you ever need to clear an mobius, you can use the “clear” shortcode below.

	[clear]

----

###Clear with Horizontal line:

Similar to “clear”, this does the same thing but adds a horizontal line below.

	[clearline]

----

##Layout Customization Hooks

You can find a list of these hookable actions and functions throughout functions.php:

* __st\_above\_header__ // Hook to add content before header
* __st\_header\_open__ // Opening header tags
* __st\_header\_extras__ // Additional content to be added to the header
* __st_logo__ // Override the theme logo function(s)
* __st\_header\_close__ // Closing Header tags
* __st\_below\_header__ // Hook to add content after header
* __st_navbar__ // Opening navigation mobius and WP3 menus
* __st\_before\_content__ // Hook to add content before content
* __st\_after\_content__ // Hook to add content after the content
* __st\_before\_comments__ // Hook to add content before comments
* __st\_after\_comments__ // Hook to add content after comments
* __st\_before\_footer__ // Hook to add content before the footer
* __st_footer__ // The footer (includes sidebar-footer.php)
* __st_footernav__ // Footer navigation menus
* __st\_after\_footer__ // Hook to add content after the footer
