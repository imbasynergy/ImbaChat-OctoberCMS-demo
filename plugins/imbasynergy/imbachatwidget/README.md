# https://octobercms.com/plugin/ImbaChat-OctoberCMS 

## Plugin usage:
Page:
- Include `[imbaChat]` component to your layout file.

- The `[imbaChat]`  component inserts javascript to initialize: 
    ```
    {% component 'ImbaChat'  %}
    ```
Config:
- `dev_id` - id developers.
- `in_password` - password to form token. This parameter set on page admin.
- `login` and `password` need to set sthrough the colon in field `out_password`  on page admin
