<?php
/**
 * Copyright 2012 by Donald Atkinson (aka Fuzzical Logic) fuzzicallogic@gmail.com
 * Created on 09-04-2012
 *
 * fixPluginPriorityCompatibility is free software; you can redistribute it and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation; either version 2 of the License, or (at your option) 
 * any later version.
 *
 * fixPluginPriorityCompatibility is distributed in the hope that it will be useful, 
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or 
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * fixPluginPriorityCompatibility; if not, write to the Free Software Foundation, 
 * Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 */

/*
 * PluginCompatbilityList is a MODx Plugin Resolver that you may include in your 
 * Transport Package to automatically fix priorities according to which Plugins may be
 * installed. This Resolver will run on Install, Update, or Uninstall and only adjust
 * known Plugins that may conflict with each other in Priority of shared System Events.
 * 
 * This Resolver insures that your addon's Plugin will not break the functionality of
 * another person's addon, and help to resolve "bug reports" that may arise as a result
 * of a compatibility issue.
 *
 * If your Plugin is not listed here, please fork my repository, add your Plugins, and 
 * make a pull request.
 * 
 * Repository: http://github.com/FuzzicalLogic/PluginCompatibilityList
 *
 */


/* @var $object xPDOObject */
/* @var $modx modX */
/* @var array $options */
if ($object->xpdo) 
{//Set the MODx Object
    $modx =& $object->xpdo;
/* 
 * Set up the Array for the Plugins to fix. Add your Plugin here, if you know of any
 * potential conflicts. 
 *
 * ARRAY STRUCTURE:
 *   $fixPlugins[SystemEvent][PluginName] 
 */
    $fixPlugins = array();
    $fixPlugins['OnPageNotFound'] = array()
    $fixPlugins['OnPageNotFound'][] = 'hookForceLowerCase';
    $fixPlugins['OnPageNotFound'][] = 'hookGetRequestType';
    $fixPlugins['OnPageNotFound'][] = 'hookParseURLParameters';
    $fixPlugins['OnPageNotFound'][] = 'hookFindSiteAlias';
    $fixPlugins['OnPageNotFound'][] = 'hookFindTemplateAction';
    $fixPlugins['OnPageNotFound'][] = 'hookNoCustomAliasFound';
    $fixPlugins['OnPageNotFound'][] = 'ArchivistFurl';
    $fixPlugins['OnPageNotFound'][] = 'ArticlesPlugin';
    $fixPlugins['OnLoadWebDocument'] = array()
    $fixPlugins['OnLoadWebDocument'][] = 'hookSwitchTemplate';
    $fixPlugins['OnLoadWebDocument'][] = 'hookDegradeGracefully';
    $fixPlugins['OnLoadWebPageCache'] = array()
    $fixPlugins['OnLoadWebPageCache'][] = 'hookSwitchTemplate';
    $fixPlugins['OnLoadWebPageCache'][] = 'hookDegradeGracefully';


/*
 * DO NOT MODIFY THIS CODE UNLESS THERE IS A GLARING BUG!
 */

// Do on Install, Update, and Uninstall
    switch ($options[xPDOTransport::PACKAGE_ACTION]) 
    {   case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
        case xPDOTransport::ACTION_UNINSTALL:
        // Loop through each. Fix the Priorities.
            foreach ($fixPlugins as $event => $list)
            {//Reset the Priority (this is a different Event)
                $priority = 0;
                foreach($list as $plugin)
                {//Get the Plugin based on the Event
                    $plugin = $modx->getObject('modPlugin', array('name' => $plugin));
                    if ($plugin)
                    {   $id = $plugin->get('id');
                        $event = $modx->getObject(
                            'modPluginEvent', 
                            array
                            (   'pluginid' => $id,
                                'event' => $event,
                            )
                        );
                    // Create the event and set the Priority
                        if ($event == null) {
                            $event = $modx->newObject('modPluginEvent');
                            $event->set('pluginid', $id);
                            $event->set('event', $event);
                            $event->set('priority', $priority);
                            $event->save();
                            $priority++;
                        }
                    // Set the Priority
                        else
                        {   $event->set('priority', $priority);
                            $event->save();
                            $priority++;
                        }
                    }
                }
            }
            break;
    }
}

return true;