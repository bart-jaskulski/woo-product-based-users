# WooCommerce plugin for grouping members

To get started run

`composer install` then `composer install-codestandards`

And hack around the code. Ofc you will have to put it into living WordPress with WooCommerce.

## Useful WC hook

This may become useful [woocommerce_new_customer_data](https://woocommerce.github.io/code-reference/files/woocommerce-includes-wc-user-functions.html#source-view.86). With that data the user is created.

## Implementation details

* Admin user has to have the possibility to choose which WordPress role to assign. Put it somewhere around the product options.
* For now let's assume, there's only one role you can assign at the time.
  * Don't bother about creating new user roles, it will be covered somewhere else.
  * Additionally, do not let to assign Administrator role for security reasons. [not required initially]
* When user buys product with selected registration role, the role has to be assigned to his, that's the core. If there was no role, back to defaults.

## Dev env

With composer you install [grumphp](https://github.com/phpro/grumphp/). For now with simple config, that tool checks whether you have added description to git commit and if you code follows WP coding standard. Soon I'll improve.

---

### Update:

Grumphp should be ruthless now. Added some configs to composer, with two commands:
* `run-phpcs` for checking if your code follows rules,
* `run-phpcbf` for automatically fix small issues
