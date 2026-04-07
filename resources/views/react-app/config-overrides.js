const { override, addWebpackAlias } = require('customize-cra');

module.exports = override(
  addWebpackAlias({
    '@fortawesome/free-brands-svg-icons': '@fortawesome/free-brands-svg-icons',
  })
);
