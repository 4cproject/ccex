Curation Cost Exchange
====

This is the development page of the curationexchange.org platform, specifically the curation cost comparison tool, which allows you to submit and compare your costs with others.

[**www.curationexchange.org**](http://www.curationexchange.org/) is a site that allows you to *understand what you and others are and should be spending in digital curation*. It is based on [Joomla!](http://www.joomla.org/) and is implemented by a theme and a component that implements the interactive part of the site, the cost comparison tool.

You can install your own version of the www.curationexchange.org and allow your institution and partners to submit and share curation costs.

## Installation guide

The CCEx tool is implemented by a template (**ccex_template**) and a component (**com_ccex**), both with a simple and straight forward installation, very similar with other Joomla 3rd party components.

### Requirements

For the correct operation of the CCEx tool, is recommended the following environment.
* **Joomla! 3.3**: version 3.3.1 or greater (>= 3.3.6 recommended)
* **PHP 5**: version 5.3.1 or greater (>= 5.3.1 recommended)
* **MySQL 5**: version 5.1 or greater (>= 5.5.4 recommended)

*Please note that, although the CCEx can work with different version, it was only tested in the versions recommended above.* 

### Download

Download the latest version:

| Version | Size   | SHA1                                                    | Download             |
|---------|--------|---------------------------------------------------------|----------------------|
| v1.0.1  | 7.3 MB<br>0.2 MB | <sub>e6b10d8c2893533e6173633519fc618069bbd263</sub><br><sub>ffc89ae3ffcb74eedaf9ef1ba6bdec13699f91a6</sub> |[template](https://github.com/4cproject/ccex/releases/download/v1.0.1/ccex_template.zip)<br>[component](https://github.com/4cproject/ccex/releases/download/v1.0.1/com_ccex.zip)|

### Installing
Installing comprises two steps: installing the CCEx template and installing the CCEx component.

#### 1. Installing the CCEx template

 1. **Install via Admin Panel:** Once you have the template downloaded on your computer, login to the administrative area of your Joomla website and upload the template `ccex_template.zip` through `Extensions > Extension Manager > Upload Package File`.

 2. **Verify installation:** Go to `Extension Manager > Manage` and search for `CCEx Template`. If the template appears on the list it is properly installed. 

 3. **Change default Joomla template:** Now you need to make it default for your website so your pages get the new design. Go to `Extensions > Template Manager`, where you will see a list of the installed templates available for your site and the administrative area,  locate the `CCExTemplate` and click on the star icon next to it.

#### 2. Installing the CCEx component
*To be described.*


## Using
*To be described.*

## License
All source code is available under [Apache License 2.0](http://www.apache.org/licenses/LICENSE-2.0). 

## Features
*To be described.*

### Version 1.1.0
*To be described.*

### Version 1.0.0
*To be described.*

## Contribute
1. [Fork the GitHub project](https://help.github.com/articles/fork-a-repo)
2. Change the code and push into the forked project
3. [Submit a pull request](https://help.github.com/articles/using-pull-requests)

To increase the chances of your changes being accepted and merged into the official source here’s a checklist of things to go over before submitting a contribution. For example:
* Has unit tests (that covers at least 80% of the code)
* Has documentation (at least 80% of public API)
* Agrees to contributor license agreement, certifying that any contributed code is original work and that the copyright is turned over to the project

## Development roadmap
List of features envisioned to be implemented in following versions:
* Support for multiple organizations per user
* Support for multiple users per organization (including ownership and transfer)
