Feature: Check whether themes are up to date

  Scenario: Themes are up to date
    Given a WP install

    When I run `wp doctor check theme-update`
    Then STDOUT should be a table containing rows:
      | name          | status  | message                                 |
      | theme-update  | success | Themes are up to date.                  |

  Scenario: One theme has an update available
    Given a WP install
    And I run `wp theme install p2 --version=1.5.1`

    When I run `wp doctor check theme-update`
    Then STDOUT should be a table containing rows:
      | name          | status  | message                                 |
      | theme-update  | warning | 1 theme has an update available.       |
