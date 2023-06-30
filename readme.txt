=== Mailcoach ===
Contributors: nielsvanp
Donate link: https://github.com/sponsors/spatie
Tags: mail, mass mailing, spatie, mailcoach, developer
Requires PHP: 8.1
Requires at least: 8.1
Tested up to: 6.2
Stable tag: 0.0.10
License: MIT

Mailcoach is an email marketing platform that covers all your email needs for a fraction of the cost. Don't pay for subscribers, pay for what you send.

== Description ==

## Introduction

[Mailcoach](https://mailcoach.app) is both a self-hosted and hosted email marketing platform that integrates with services like Amazon SES, Mailgun, Postmark or Sendgrid to send out bulk mailings and drip campaigns affordably. It can also keep track of all transactional mails sent out by your app.

Cloud, stand-alone, or integrated in a project, it's the perfect email list service for bloggers, artisans and entrepreneurs.


This plugin allows admins to create a subscribe form to a mailcoach email list. This can be plugged into your website with a shortcode.


## Installation

To install the Mailcoach plugin, follow these steps:

1. Go to your WordPress site and navigate to the "Plugins" section.
2. Click on the "Add New" button.
3. Search for "Mailcoach" and click on the plugin.
4. Click "Activate" to enable the plugin.
5. You will now be able to see Mailcoach in your Admin navigation.

Alternatively, you can download the plugin directly from the WordPress plugin store at https://wordpress.org/plugins/forms-mailcoach/.

![](https://blog.mailcoach.de-fra1.upcloudobjects.com/WNYT3ePe9wh2UTVBBv103zmoXtXHqmn3JSGzQFls.png)

## Using Mailcoach

### Setting up your credentials

Before we can proceed, we need an API Token and Mailcoach URL. You can find this information in the settings of your Mailcoach profile on your Mailcoach instance.

1. Log in to your Mailcoach instance and access your Mailcoach profile settings.
2. Create a new API Token.
3. In your WordPress Admin panel, navigate to Mailcoach settings and enter the API Token and Mailcoach URL.
4. Save the settings.
5. You should be able to view all your email lists with the number of subscribers. If no lists are displayed, make sure you create a list on your Mailcoach instance first.

![](https://blog.mailcoach.de-fra1.upcloudobjects.com/3lO5o6vFQWxN4BwIhUqIABSELQKu6A9dixwhLQAl.png)

### Creating a subscribe form

Now let's move on to the core functionality of the plugin.
Navigate to the "Forms" or "Add Form" section in the WordPress Admin panel.

You may encounter a warning regarding the "Email List" with the message "External form subscriptions are not enabled for this list. Please enable them in the Mailcoach dashboard."
To enable external form subscriptions, go to the email list settings on your Mailcoach instance.
Access the "Onboarding" tab and enable the option "Allow POST from an external form." Don't forget to save.

After saving the form, you will notice a shortcode field that cannot be updated. Copy the shortcode for later use.

### Adding the subscribe form to your website

To display the form on a specific page, follow these steps:

1. Go to the desired page where you want to show the form.
2. Paste the copied shortcode where you want the form to appear.
3. Make sure the shortcode is enclosed within [brackets].
4. After inserting the shortcode, view the page to test if the form is working correctly. Please note that there is spam protection in place using Cloudflare turnstile.

You also have the option to customize the messages displayed to the user after they attempt to subscribe.
