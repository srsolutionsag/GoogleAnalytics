# ILIAS Google Analytics Plugin

Tracks page views with Google Analytics by injecting the Google Analytics code at the end of the page.

### Features:
- IP addresses may be anonymized.
- File downloads may be tracked as events.
- Google TagManager may be used

### Installation
Put the contents of this folder into
`./Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/GoogleAnalytics`

Enable the plugin in the plugin administration and specify your account id.

### History
- `2.0.0` Support for ILIAS 7
- `1.0.3` Feature: Added support for Google TagManager and updated plugin for ILIAS v5.4.
- `1.0.1` Bugfix: Downloads were not tracked if the FileHandling-Patch was not installed.
- `1.0.0` Initial release


### Known Issues
None
