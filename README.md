Curation Cost Exchange
====

This is the development page of the curationexchange.org platform, specifically the curation cost comparison tool, which allows you to submit and compare your costs with others.

[**www.curationexchange.org**](http://www.curationexchange.org/) is a site that allows you to *understand what you and others are and should be spending in digital curation*. It is based on [Joomla!](http://www.joomla.org/) and is implemented by a theme and a component that implements the interactive part of the site, the cost comparison tool.

You can install your own version of the www.curationexchange.org and allow your institution and partners to submit and share curation costs.

## How to install and use

The CCEx tool is implemented by a template (**ccex_template**), a component (**com_ccex**) and static pages, all with a simple and straight forward installation, very similar with other Joomla 3rd party components.

### Requirements

For the correct operation of the CCEx tool, is recommended the following environment.

* **Joomla! 3.3**: version 3.3.1 or greater (>= 3.3.6 recommended)
* **PHP 5**: version 5.3.1 or greater (>= 5.3.1 recommended)
* **MySQL 5**: version 5.1 or greater (>= 5.5.4 recommended)
 
It is also required the installation of the following Joomla! components:

* **J2XML 3**: version 3.1.1 or greater (>= 3.1.1 recommended)
* **Forever Sessions 2**: version 2.0.1 or greater (>= 2.0.1 recommended) 

*Please note that, although the CCEx can work with different version, it was only tested in the versions recommended above.*

### Download

Download the latest version:

| Version | Size   | SHA1                                                    | Download             |
|---------|--------|---------------------------------------------------------|----------------------|
| v1.1.0  | 8.57 MB<br>231 KB<br>98.2 KB | <sub>02f8728fb444b0656bfabc16d3aca0c383aceac6</sub><br><sub>569d5c97032a9c952cde918af36102b60b29b174</sub><br><sub>a63ab9f2cfd455b21a6502f510f201b4e221170f</sub> |[ccex_template.zip](https://github.com/4cproject/ccex/releases/download/v1.1.0/ccex_template.zip)<br>[com_ccex.zip](https://github.com/4cproject/ccex/releases/download/v1.1.0/com_ccex.zip)<br>[static_pages.xml](https://github.com/4cproject/ccex/releases/download/v1.1.0/static_pages.xml)|

### Install instructions
Installing comprises tree steps: installing the CCEx template, installing the CCEx component and load the static pages.

Installing the CCEx template **ccex_template.zip**:

 1. **Install template:** Login to the administrative area of your Joomla website and upload the template through `Extensions > Extension Manager > Upload Package File`.

 2. **Verify installation:** Go to `Extension Manager > Manage` and search for "CCEx Template". If the template appears on the list then it is properly installed.

 3. **Change default Joomla template:** Now you need to make it default for your website so your pages get the new design. Go to `Extensions > Template Manager` and locate the "CCExTemplate". Click on the :star: star icon next to it.  

Installing the CCEx component  **com_ccex.zip**:

1. **Install component:** On the administrative area upload the component through `Extensions > Extension Manager > Upload Package File`.

2. **Add "Curation costs" to menu:**  On  `Menus > Main Menu > Add New Menu Item` set *Menu Title* as "Curation costs" and select the *Menu Item Type* as `Curation Cost Exchange > Compare Costs`. Click Save & Close to save and be redirected to *Menu Items*' page where you can reorder all the menu items.

3. **Add "Administration" menu:** On `Menus > Main Menu > Add New Menu Item` set *Menu Title* as "Administration" and select the *Menu Item Type* as `Curation Cost Exchange > Administration`. Set Access to "Super Users" and click Save.

4. **Add profile menu:** On `Menus > Main Menu > Add New Menu Item` set *Menu Title* as "Profile" and select the *Menu Item Type* as `Curation Cost Exchange > Profile`. Click Save.

Install static pages:

1. **Import static pages:** Go to `Components > J2XML > Control Panel`, choose the `static_pages.xml` file and click `import`.

2. **Add home page:** On  `Menus > Main Menu > Add New Menu Item` set *Menu Title* as "Home", select the *Menu Item Type* as `Articles > Single Article` and select the article `Home`. Click Save & Close to save and be redirected to *Menu Items*', move the *Home's Menu Item* to top and click on the :star: star icon next to it to set it as default home page.

3. **Add about menu:** On  `Menus > Main Menu > Add New Menu Item` set *Menu Title* as "About", select the *Menu Item Type* as `Articles > Single Article` and select the article `About` and Save.

4. **Add help menu:** On  `Menus > Main Menu > Add New Menu Item` set *Menu Title* as "Help", select the *Menu Item Type* as `Articles > Single Article` and select the article `Help` and Save.

### Use
After installation the Cost Comparison Tool will be available under the menu item you have selected. If you are not signed in and click on the menu item you will be presented with a video and a step-by-step tutorial similar to the one available at the [official site](http://www.curationexchange.org/compare-costs?view=comparecosts&layout=tour). Signing-in you will be taken into a workflow to define your organisation, define your costs and compare them with the other organisations available on your instance.

Please note that cost information of othen organisations available on the oficial site will not be available on your instance. Also, the information you provide in your own instance will **not** be shared with the oficial site.

Also, please note that other static information available on the oficial site, like: About, Understand your costs, Read more, and Vendor Services will not be available on your instance.

If your user has the role of "Super User" on Joomla! you will be able to access the Administrator menu, where you can manage the Cost Comparison Tool.

After login you can also access your own profile by clicking the menu item with your user full name.

### Troubleshooting

**Error installing template: Copy failed**<br>
When changing the template via the administrator and then installing a new version of the template the error message `Copy failed` might appear. You will need to undo the changes done to the template or uninstall the previous version of the template prior to installing the new one.

## More information

### License
All source code is available under [Apache License 2.0](http://www.apache.org/licenses/LICENSE-2.0).

### Publications
Related publication are available on the [4C project outputs page](http://www.curationexchange.org/read-more/67-4c-project-outputs).

## Features and roadmap
Features developed on every version and proposed features for next versions.

### Version 1.1.0
* Video tour and step-by-step tutorial on start page
* In-page help tours on every page ("Show help" button on the top-right)
* Updated profile page
* Updated template

### Version 1.0.0
* Organisation profile
* Manage cost data sets, add cost units and map costs into categories
* Analyse own costs, compare costs with groups and with peers
* Creating cost groups automatically with organisation profile and cost data set properties
* Peer similarity based on organisation profile and cost data set properties
* Request peer contact
* Profile page
* Administration page with browse and export features of all data and control over configurations
* Design template

### Development roadmap
List of features envisioned to be implemented in following versions:
* Support for multiple organizations per user
* Support for multiple users per organization (including ownership and transfer)

## Develop

### Requirements

The source code is all on PHP and doesn't need any special requirements to develop.

### Build

To build zip the folders **ccex_template/** and **com_ccex/**:
```bash
zip -r ccex_template.zip ccex_template/
zip -r com_ccex.zip com_ccex/
```

### Contribute
1. [Fork the GitHub project](https://help.github.com/articles/fork-a-repo)
2. Change the code and push into the forked project
3. [Submit a pull request](https://help.github.com/articles/using-pull-requests)

To increase the chances of your changes being accepted and merged into the official source here’s a checklist of things to go over before submitting a contribution. For example:
* Has unit tests (that covers at least 80% of the code)
* Has documentation (at least 80% of public API)
* Agrees to contributor license agreement, certifying that any contributed code is original work and that the copyright is turned over to the project
