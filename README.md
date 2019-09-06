[![ImbaChat](http://imbachat.com/themes/imbachat/assets/img/logo.svg "ImbaChat")](http://imbachat.com "ImbaChat")

# Chat widget for October CMS

This is a free plugin for integrating October CMS with imbachat.com chat service
Allows you to add a chat widget for free between users of your site.

# Links

[Demo site](http://octobercms.imbachat.com)

[Plugin for October cms](https://octobercms.com/plugin/imbasynergy-imbachatwidget)

[Source code of the demo site](https://github.com/imbasynergy/ImbaChat-OctoberCMS-demo)

[Technical support](http://imbachat.com/help)

# Features

- Full integration with the user base of your website
- Single authorisation mechanism in a chat and on a website (users need not sign up in a chat)
- Chatting between users mano y mano
- Sending pictures
- Sending geolocation
- Sending smiles
- Real time message delivery
- It does not load your server (The chat widget uses project servers imbachat.com)
- You can use it on shared hosting
- It continues correct working even without the Internet (Your messages will be sent as soon the Internet appears)
- You can build it into HTML5 mobile app

[![Chat demo](http://imbachat.com/storage/app/uploads/public/docs/demo.gif "Chat demo")](https://imbachat.com "Chat demo")


## Steps to install a chat widget:
- Install this plugin on your website
- Register on the site [imbachat.com](https://imbachat.com)
- Go to the [widget page](https://imbachat.com/admin/widgets). and create yourself a widget
- In the process of creating a widget, you will need to select "Integration with October CMS" and follow the instructions

### Insert a chat component on a page

- Connect the `[imbaChat]` component in the page file.
- `[imbaChat]` component inserts javascript that initializes the chat widget

```{% component 'ImbaChat'  %}```
