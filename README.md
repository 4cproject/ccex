Curation Cost Exchange
====

This is the development page of the curationexchange.org platform, specifically the curation cost comparison tool, which allows you to submit and compare your costs with others.

[**www.curationexchange.org**](http://www.curationexchange.org/) is a site that allows you to *understand what you and others are and should be spending in digital curation*. It is based on [Joomla!](http://www.joomla.org/) and is implemented by a theme and an extension that implements the interactive part of the site, the cost comparison tool.

You can install your own version of the www.curationexchange.org and allow your institution and partners to submit and share curation costs.

## Installation guide

The CCEx tool is implemented by a theme (**ccex_template**) and an extension (**com_ccex**), both with a simple and straight forward installation, very similar with other Joomla 3rd party components.

#### Installing the CCEx template

**1. Download template**

Before you begin, remember to download as **zip** the latest version of the CCEx Template (**ccex_template**) from the [releases page](https://github.com/4cproject/ccex/releases) .

**2. Install via Admin Panel**

Once you have the template downloaded on your computer, login to the administrative area of your Joomla website *(yourdomain/administrator)* and upload the template through the **Extension Manager** *(Extensions -> Extension Manager -> Upload Package File)*.

**3. Verify installation**

Go from (Extension Manager: Install) to (**Extension Manager: Manage**), and search extensions by "**CCEx Template**". The installed template should appear in the list. If it does, the template is properly installed. 

**4. Change default Joomla template**

Once the template is properly installed, you need to make it default for your website so your pages get the new design. 

Go to **Template Manager** *(Extensions -> Template Manager)*,  where you will see a list of the installed templates available for your site and the administrative area,  locate the **CCExTemplate** and click on the star icon next to it.

### Requirements

For the correct operation of the CCEx tool, is recommended the following environment.

    Joomla! 3.3: version 3.3.1 or greater (>= 3.3.6 recommended)

    PHP: version 5.3.1 or greater (>= 5.3.1 recommended)
    MySQL: version 5.1 or greater (>= 5.5.4 recommended)

*Please note that the tool was only tested in the recommended versions.* 

### Download
*To be described.*

### Installing
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
