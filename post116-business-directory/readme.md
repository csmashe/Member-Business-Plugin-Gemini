# Post 116 Business Directory

This plugin provides a business directory for the American Legion Post 116 website.

## Installation

1. Upload the `post116-business-directory` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. A 'Businesses' menu item will appear in your WordPress admin.
4. A 'Business Directory' page will be created with the `[p116/directory]` block.

## QA Checklist

- [ ] Add/edit/delete a business.
- [ ] Verify that the city field is required.
- [ ] Search for a business by name, owner, and category.
- [ ] Verify that the autocomplete suggestions work on the search field.
- [ ] Verify that the JSON-LD schema is present on single business pages.
- [ ] Verify that the directory page renders correctly.
- [ ] Verify that the category archive pages render correctly.
- [ ] Verify that the ownership flags are displayed correctly.
- [ ] Verify that the business card links to the single business page.

## Notes

- The Gutenberg block's JavaScript needs to be built using `@wordpress/scripts`. Run `npx wp-scripts build` in the `blocks/directory` directory.
- The plugin uses a custom capability `p116_business` to control access to the business directory. By default, all roles have this capability.
- The plugin creates a custom post type `p116_business` and a custom taxonomy `p116_business_category`.
- The plugin creates a settings page under `Settings > Business Directory`.
