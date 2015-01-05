Feature: Admin

  Scenario: I am on the admin dashboard
    When I am on the "/admin/dashboard" page
    Then I should see "Administration"

  Scenario: I want to create a new arret
    Given I am on the "/admin/arret" page
    When I click the "Ajouter" button
    Then I am on the "/admin/arret/create" page
    And I fill out the form to create a new arret
    Then I should see "TEST_A234"

  Scenario: I want to create a new analyse
    Given I am on the "/admin/analyse" page
    When I click the "Ajouter" button
    Then I am on the "/admin/analyse/create" page
    And I fill out the form to create a new analyse
    Then I should see "TEST_ANALYSE_A234" a new analyse