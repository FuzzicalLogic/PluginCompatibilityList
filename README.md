# PluginCompatibilityList
---
PluginCompatbilityList is a MODx Plugin Resolver for [MODx Revolution](http://modx.com/) that you may include in your Transport Package to automatically fix priorities according to which Plugins are currently installed. This Resolver will run on Install, Update, or Uninstall and only adjust known, installed Plugins that may conflict with each other in Priority of shared System Events.

This Resolver insures that your addon's Plugin will not break the functionality of another developer's addon, and help to resolve "bug reports" that may arise as a result of a compatibility issue.

If your Plugin is not listed here, please fork my repository, add your Plugins, and make a pull request.

Repository: [http://github.com/FuzzicalLogic/PluginCompatibilityList](http://github.com/FuzzicalLogic/PluginCompatibilityList)

## Usage
Depending upon your build package method, the specific steps made may be different.

* Download the file.
* Place wherever you include your resolvers.
* Review the $fixPlugins array.
* Add this resolver to your Plugins Resolver list. 
  * In [MyComponent](http://github.com/BobRay/MyComponent/), this is done in pluginname.build.config.

## Adjusting the Array
If a System Event is not listed:
* Add the line `$fixPlugins['OnEventName'] = array();` at the end of the array.
* Change OnEventName to the MODx Revolution System Event that it uses.

If your Plugin is not listed in a System Event:
* Add the line `$fixPlugins['OnEventName'][] = 'MyPluginName';` above/below/between the Plugins it may conflict with.
* Change OnEventName to the appropruate MODx Revolution System Event.
* Change MyPluginName to the name of your Plugin as it appears in the MODx Revolution Elements tab.
* Notify me, or fork the repo, so that we can include this for everyone.

## MODx Extras that use PluginCompatibilityList
* [AJAX Revolution](http://github.com/nTouchSoftwareLLC/AJAX-Revolution/)
* [Contextualize](http://github.com/nTouchSoftwareLLC/Contextualize/)
* [Objectify](http://github.com/nTouchSoftwareLLC/Objectify/)
