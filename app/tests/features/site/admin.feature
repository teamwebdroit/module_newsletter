Feature: Admin

  Scenario: I am on the admin dashboard
    When I am on the "/admin/dashboard" page
    Then I should see "Administration"

  Scenario: I want to create a new arret
    Given I am on the "/admin/arret" page
    When I click the "Ajouter" button
    Then I am on the "/admin/arret/create" page
    And I fill out the form to create a new arret
    Then I should see "Éditer TEST_A234"

  Scenario: I want to create a new analyse
    Given I am on the "/admin/analyse" page
    When I click the "Ajouter" button
    Then I am on the "/admin/analyse/create" page
    And I fill out the form to create a new analyse
    Then I should see "Éditer l'analyse de TEST_ANALYSE_A234" a new analyse

  Scenario: I want to create a new content
    Given I am on the "/admin/contenu" page
    When I click the "Ajouter" button
    Then I am on the "/admin/contenu/create" page
    And I fill out the form to create a new contenu
    Then I should see "Éditer TEST_Contenu"

  Scenario: I want to create a new categorie
    Given I am on the "/admin/categorie" page
    When I click the "Ajouter" button
    Then I am on the "/admin/categorie/create" page
    And I fill out the form to create a new categorie
    Then I should see "Éditer TEST_categorie"