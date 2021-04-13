# Haus Sausage Co.

> Woocommerce theme developed by FOE creative team.

## Theme details

Used Underscore as the boilerplate theme. Optimized using the webpack configuration.

### Instruction for theme development.

1. Goto the Theme diectory
2. In `src` folder, there are four sub folders such as;
   - `scss` : Styles should be updated in the `scss` folder.
   - `js` : Use JQuery (served from the `webpack.config` file).
   - `images` : Use the bg images that are necessary for the styles goes in this folder. Note : Try to use svg images as icon, since webpack will convert it into data/xml (which will reduce the file size)
   - `fonts` : Used to add the fonts that are used in this theme.
3. Use `npm run production` : to generate the output files in dist folder. Two more commands are available in `package.json` file.
4. Use `inc/woocommerce.php` for any hooks and filters for woocomemrce template changes.
