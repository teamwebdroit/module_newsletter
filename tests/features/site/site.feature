Feature: Site

  Scenario: I am on the homepage
    When I am on the "/" page
    Then I should see "Nouveautés dans le domaine du droit du travail"

  Scenario: I am on the jurisprudence page
    When I am on the "/jurisprudence" page
    Then I should see "Jurisprudence"

  Scenario: I am on the Newsletter page
    When I am on the "/newsletters" page
    Then I should see "Newsletter"

  Scenario: I am on the colloque page
    When I am on the "/colloque" page
    Then I should see "Colloque"

  Scenario: I am on the contact page
    When I am on the "/contact" page
    Then I should see "Contact"