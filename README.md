# PluginCompatibilityList
---
PluginCompatbilityList is a MODx Plugin Resolver for MODx Revolution that you may include in your Transport Package to automatically fix priorities according to which Plugins are currently installed. This Resolver will run on Install, Update, or Uninstall and only adjust known, installed Plugins that may conflict with each other in Priority of shared System Events.

This Resolver insures that your addon's Plugin will not break the functionality of another developer's addon, and help to resolve "bug reports" that may arise as a result of a compatibility issue.

If your Plugin is not listed here, please fork my repository, add your Plugins, and make a pull request.

Repository: [http://github.com/FuzzicalLogic/PluginCompatibilityList](http://github.com/FuzzicalLogic/PluginCompatibilityList)

## Usage
Depending upon your build package method, the specific steps made may be different.

* Download the file.
* Place wherever you include your resolvers.
* Add this resolver to your Plugins Resolver list. 
  * In MyComponent, this is done in pluginname.build.config.

## MODx Extras that use PluginCompatibilityList
* [AJAX Revolution](http://github.com/nTouchSoftwareLLC/AJAX-Revolution/)
* [Contextualize](http://github.com/nTouchSoftwareLLC/Contextualize/)
* [Objectify](http://github.com/nTouchSoftwareLLC/Objectify/)
