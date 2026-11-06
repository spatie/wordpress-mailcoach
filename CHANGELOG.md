## 0.0.18 - 2026-11-06

### Requirements

PHP **8.3 or newer** and WordPress **6.2 or newer** remain required, unchanged from 0.0.17. Compatibility is tested through WordPress 7.1.4 on PHP 8.3, 8.4 and 8.5. This is a patch plugin release containing explicitly approved dependency-major upgrades.

### Changes since 0.0.17

- Upgrade the bundled HTTP runtime to **Guzzle 8.3.1**, **Guzzle Promises 3.1.0** and **Guzzle PSR-7 3.2.0**, from 7.16.1, 2.6.0 and 2.13.2 respectively (#33). Mailcoach SDK remains **1.10.0**.
- Bundle the ctype polyfill in production so hosts without native `ctype` can construct and use the new HTTP client. The production-only explicit-port regression failed before this correction and passes afterward; CI now exercises production client creation with native ctype genuinely disabled.
- Update the associated Symfony polyfills/deprecation contracts within their existing majors and remove the no-longer-required getallheaders polyfill.
- Include the already merged, development-only removal of unused CodeSniffer and its ruleset/contributor references (#32). PHP-CS-Fixer is preserved; this removal has no standalone runtime release.
- Preserve plugin application source, resources and the existing self-managed/unsupported project status. No #31 or separately owned PHP 8.6 work is included.

The HTTP stack now follows Guzzle 8/PSR-7 3 validation and transport/error semantics. WordPress dependency loading continues to use Jetpack's existing shared version-selection mechanism, not isolated namespaces; compatibility with every third-party plugin is not guaranteed.

### Validation

- Full suite: **10 tests / 33 assertions**; PHPStan, formatting, Composer strict validation, platform checks and advisory audit passed.
- Runtime CI covers PHP 8.3/8.4/8.5 with WordPress 7.1.4 and PHP 8.3 with minimum WordPress 6.2.0, including initialized-database production smoke with and without native ctype.
- Real disposable HTTP/WordPress checks exercise Bearer/JSON headers, subdirectory and explicit-port endpoints, next/previous pagination, list hydration/form filtering, same-origin redirects, cross-origin token stripping, SDK error mappings/body/Retry-After, and connection-refusal fallback. Production ZIP checks use actual cURL and stream transports, not mocks. No request to a remote Mailcoach instance is claimed.

### Known limitation

Fresh activation with WordPress debugging enabled can report unexpected output when shortcode registration queries the forms table before the activation hook creates it. This separately reported issue remains unchanged. Passing activation coverage uses an initialized disposable database and does not establish missing-table fresh-activation success; no published-distribution before/after comparison is claimed.

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.17...0.0.18

## 0.0.17 - 2026-11-06

### Requirements

**PHP 8.3 or newer is now required (previously PHP 8.1). Upgrade PHP before updating the plugin.** The WordPress minimum remains 6.2; compatibility is tested through WordPress 7.1.4.

### Changes since 0.0.16

- Bundle Mailcoach SDK 1.10.0 (the last published plugin bundled 1.7.0), with PHP requirements aligned across Composer and WordPress metadata.
- Update Guzzle 7 and its dependencies to patched releases without adopting Guzzle 8.
- Repair WordPress integration-test bootstrapping and restore actual runtime CI on PHP 8.3, 8.4 and 8.5, including the minimum WordPress version, email-list HTTP integration, form-list filtering and production-only activation.
- Build the WordPress distribution from the lockfile on PHP 8.3 without bypassing platform requirements; check platform compatibility and security advisories.
- Include previously unreleased documentation, contributor and development-tool/CI maintenance. The existing self-managed/unsupported project status is unchanged.

### Known limitation

Fresh activation with WordPress debugging enabled can report unexpected output when shortcode registration queries the forms table before the activation hook creates it. This issue was observed during review and is intentionally left unchanged for separate consideration. Passing activation coverage uses an initialized test database and does not establish missing-table activation success; no published-distribution before/after comparison was performed.

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.16...0.0.17

## 0.0.16 - 2024-10-02

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.15...0.0.16

## 0.0.15 - 2024-10-02

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.14...0.0.15

## 0.0.14 - 2024-10-02

### What's Changed

* Bump stefanzweifel/git-auto-commit-action from 4 to 5 by @dependabot in https://github.com/spatie/wordpress-mailcoach/pull/7
* Bump actions/checkout from 3 to 4 by @dependabot in https://github.com/spatie/wordpress-mailcoach/pull/8
* Bump szepeviktor/phpstan-wordpress from 1.3.0 to 1.3.5 by @dependabot in https://github.com/spatie/wordpress-mailcoach/pull/10
* Bump guzzlehttp/guzzle from 7.7.0 to 7.9.2 by @dependabot in https://github.com/spatie/wordpress-mailcoach/pull/9
* Bump phpstan/extension-installer from 1.3.1 to 1.4.3 by @dependabot in https://github.com/spatie/wordpress-mailcoach/pull/12
* Bump yoast/wp-test-utils from 1.1.1 to 1.2.0 by @dependabot in https://github.com/spatie/wordpress-mailcoach/pull/11

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.13...0.0.14

## 0.0.13 - 2024-10-02

### What's Changed

* Bug fix: error on reactivation by @Nielsvanpach in https://github.com/spatie/wordpress-mailcoach/pull/6
* Bump braces from 3.0.2 to 3.0.3 by @dependabot in https://github.com/spatie/wordpress-mailcoach/pull/5

### New Contributors

* @dependabot made their first contribution in https://github.com/spatie/wordpress-mailcoach/pull/5

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.12...0.0.13

## 0.0.12 - 2023-06-30

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.11...0.0.12

## 0.0.11 - 2023-06-30

### What's Changed

- Docs by @Nielsvanpach in https://github.com/spatie/wordpress-mailcoach/pull/3

### New Contributors

- @Nielsvanpach made their first contribution in https://github.com/spatie/wordpress-mailcoach/pull/3

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.10...0.0.11

## 0.0.10 - 2023-06-14

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.9...0.0.10

## 0.0.9 - 2023-06-14

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.8...0.0.9

## 0.0.8 - 2023-06-14

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.7...0.0.8

## 0.0.7 - 2023-06-14

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.6...0.0.7

## 0.0.6 - 2023-06-12

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.5...0.0.6

## 0.0.5 - 2023-06-12

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.4...0.0.5

## 0.0.4 - 2023-06-09

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.3...0.0.4

## 0.0.3 - 2023-06-09

**Full Changelog**: https://github.com/spatie/wordpress-mailcoach/compare/0.0.2...0.0.3

## 0.0.1 - 2023-06-09

- genesis
