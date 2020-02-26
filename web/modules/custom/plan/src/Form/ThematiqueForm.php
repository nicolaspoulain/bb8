<?php
/**
 * @file
 * Contains Drupal\plan\Form\ThematiqueForm.
 */

namespace Drupal\plan\Form;

use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\InvokeCommand;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\bb\Controller\BbCrudController;


/**
 * Implements the ThematiqueForm form controller.
 */
class ThematiqueForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return 'Modification de la thematique';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ThematiqueForm';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $thematique=NULL, $co_modu=NULL, $co_degre=NULL, $co_tpla=NULL) {

$th_1d = array(
0=> "-",
"13"  => "13  : Accompagnement des professeurs stagiaires",
"17"  => "17  : Enseignement de l'histoire des arts",
"18"  => "18  : Intégration pédagogique des ENT",
"20"  => "20  : Numérique au sein de la discipline",
"21"  => "21  : Éducation au développement durable",
"22"  => "22  : Europe et international",
"29" => "29 : Formation réglementaire des nouveaux directeurs d'école",
"30"  => "30  : Certification CLES",
"31"  => "31  : Certification C2i2e",
"32"  => "32  : Éducation prioritaire",
"33" => "33 : Activités pédagogiques complémentaires (école)",
"37" => "37 : Enseignement du français (école)",
"38" => "38 : Enseignement des mathématiques (école)",
"39"  => "39  : Développement de la pratique des langues vivantes",
"441" => "441 : Parcours d'éducation artistique et culturelle",
"442" => "442 : Parcours éducatif de santé",
"443" => "443 : Parcours citoyen",
"49"  => "49  : Sciences cognitives et mécanismes d'apprentissage",
"50"  => "50  : Recherche et développement, innovation et expérimentation",
"51"  => "51  : Différenciation pédagogique",
"52"  => "52  : Objectifs, modalités et pratiques d'évaluation",
"53"  => "53  : Liaison Ecole-collège",
"54"  => "54  : Egalité entre les filles et les garçons",
"55"  => "55  : Laïcité",
"56"  => "56  : Dialogue avec les parents",
"57"  => "57  : Accueil élèves allophones ou familles itinérantes",
"58"  => "58  : Formations certificatives ASH",
"59"  => "59  : Autres formations ASH",
"61" => "61 : Accompagnement du dispositif CP dédoublés",
"62" => "62 : Accompagnement du dispositif CE1 dédoublés",
"63" => "63 : Maternelle - Sécurité affective",
"64" => "64 : Maternelle - Apprentissage des fondamentaux",
"65" => "65 : Maternelle - Enseignement structuré du vocabulaire",
"66" => "66 : Accompagnement du plan mathématiques",
"80"  => "80  : Lutte contre le harcèlement",
"81"  => "81  : Lutte contre les discriminations",
"82"  => "82  : Prévention de la radicalisation",
"83"  => "83  : Respecter autrui",
"84"  => "84  : Lutte contre le décrochage scolaire",
"85"  => "85  : Certification numérique PIX",
"86"  => "86  : Enseignement des sciences informatiques et numériques",
"87"  => "87  : Sécurité et protection des données",
"88"  => "88  : Secourisme",
"89"  => "89  : Certification de formateur - CAFFA, CAFIPEFM",
"90"  => "90  : Certification en langues",
"907" => "907 : Préparation aux concours ITRF",
"908" => "908 : Préparation aux concours de recrutement des personnels d'encadrement",
);

$th_2d = array(
0=> "-",
"13"  => "13  : Accompagnement des professeurs stagiaires",
"14"  => "14  : Lycée technologique : la série STI2D",
"15"  => "15  : Lycée technologique : la série STL",
"16"  => "16  : Lycée technologique : la série STD2A",
"17"  => "17  : Enseignement de l'histoire des arts",
"18"  => "18  : Intégration pédagogique des ENT",
"20"  => "20  : Numérique au sein de la discipline",
"21"  => "21  : Éducation au développement durable",
"22"  => "22  : Europe et international",
"30"  => "30  : Certification CLES",
"31"  => "31  : Certification C2i2e",
"32"  => "32  : Éducation prioritaire",
"34"  => "34  : Accompagnement éducatif (collège)",
"35"  => "35  : Accompagnement personnalisé (collège)",
"36"  => "36  : Accompagnement personnalisé (lycée)",
"39"  => "39  : Développement de la pratique des langues vivantes",
"40"  => "40  : Evaluation des compétences orales au ; baccalauréat",
"42"  => "42  : Lycée technologique : la série STMG",
"43"  => "43  : Enseignements d'exploration",
"44"  => "44  : Accompagnement à l'orientation collège lycée",
"441" => "441 : Parcours d'éducation artistique et culturelle",
"442" => "442 : Parcours éducatif de santé",
"443" => "443 : Parcours citoyen",
"45"  => "45  : Bac -3, bac +3 au lycée général et technologique",
"46"  => "46  : Bac -3, bac +3 au lycée professionnel",
"47"  => "47  : Vie de l'élève",
"48"  => "48  : Relation école-entreprise",
"49"  => "49  : Sciences cognitives et mécanismes d'apprentissage",
"50"  => "50  : Recherche et développement, innovation et expérimentation",
"51"  => "51  : Différenciation pédagogique",
"52"  => "52  : Objectifs, modalités et pratiques d'évaluation",
"53"  => "53  : Liaison Ecole-collège",
"54"  => "54  : Egalité entre les filles et les garçons",
"55"  => "55  : Laïcité",
"56"  => "56  : Dialogue avec les parents",
"57"  => "57  : Accueil élèves allophones ou familles itinérantes",
"58"  => "58  : Formations certificatives ASH",
"59"  => "59  : Autres formations ASH",
"60"  => "60  : Enseignements pratiques interdisciplinaires",
"70"  => "70  : Enseignements pratiques et interdisciplinaires",
"71"  => "71  : Baccalauréat - Le grand oral",
"72"  => "72  : TVP - Chef d'oeuvre",
"73"  => "73  : TVP - Famille des métiers",
"74"  => "74  : TVP - Co-intervention",
"80"  => "80  : Lutte contre le harcèlement",
"81"  => "81  : Lutte contre les discriminations",
"82"  => "82  : Prévention de la radicalisation",
"83"  => "83  : Respecter autrui",
"84"  => "84  : Lutte contre le décrochage scolaire",
"85"  => "85  : Certification numérique PIX",
"86"  => "86  : Enseignement des sciences informatiques et numériques",
"87"  => "87  : Sécurité et protection des données",
"88"  => "88  : Secourisme",
"89"  => "89  : Certification de formateur - CAFFA, CAFIPEFM",
"90"  => "90  : Certification en langues",
"901" => "901 : Préparation aux concours - CAPES, CAPET, CAPEPS, CAPLP",
"902" => "902 : Préparation aux concours - Agrégation",
"903" => "903 : Préparation au concours de recrutement des CPE",
"904" => "904 : Préparation au concours de recrutement des PSYEN",
"905" => "905 : Préparation au concours Administration",
"906" => "906 : Préparation au concours - Santé, social",
"907" => "907 : Préparation aux concours ITRF",
"908" => "908 : Préparation aux concours de recrutement des personnels d'encadrement",
);

if ($co_tpla=="S") {
  $thematiques = $th_2d;
} elseif ($co_tpla=="D") {
  $thematiques = $th_1d;
} else {
   $thematiques = array();
 }

  $form['co_modu']  = array('#type' => 'hidden','#value' => $co_modu );
  $form['co_degre']  = array('#type' => 'hidden','#value' => $co_degre );
  $form['thematique'] = array(
    '#type' => 'select',
    '#options' => $thematiques,
    '#default_value' => (isset($thematique))? (int)$thematique : '0',
    '#ajax' => array(
      'callback' => [$this,'saveAjax'],
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $valid = $this->validate($form, $form_state);
    return TRUE;
  }

  /**
   * Validate field.
   */
  protected function validate(array &$form, FormStateInterface $form_state) {
    return TRUE;
  }

  /**
   * Ajax callback to save field.
   */
  public function saveAjax(array &$form, FormStateInterface $form_state) {

    $coo = $form_state->getUserInput('co_modu');
    $condition = array(
      'co_modu'  => $coo['co_modu'],
      'co_degre'  => $coo['co_degre'],
    );
    $entry = array(
      'thematique'  => $form_state->getValue('thematique'),
    );
    $row = BbCrudController::load('gbb_gmodu_plus', $condition);
    if (!empty($row)) {
      $DBWriteStatus = BbCrudController::update('gbb_gmodu_plus', $entry, $condition);
    } else {
      $DBWriteStatus = BbCrudController::create('gbb_gmodu_plus', array_merge($condition,$entry));
    }
  }
}
