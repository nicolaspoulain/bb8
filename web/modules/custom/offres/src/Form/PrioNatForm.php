<?php
/**
 * @file
 * Contains Drupal\offres\Form\PrioNatForm.
 */

namespace Drupal\offres\Form;

use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\InvokeCommand;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\bb\Controller\BbCrudController;


/**
 * Implements the PrioNatForm form controller.
 */
class PrioNatForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return 'Modification de la prio_nat';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'PrioNatForm';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $prio_nat=NULL, $co_omodu=NULL, $co_tpla=NULL, $co_orie=NULL) {

  // $prios = array(
// 0=> "-",
// 1=> "Bac-3/Bac+3",
// 2=>"Climscol_lutte_harcèlement",
// 3=>"Devoirs_faits",
// 4=>"École_maternelle",
// 5=>"Éduc_artistique_et_cult",
// 6=>"Éduc_valeurs_de_la_Rép",
// 7=>"Élèves_à_besoins_éduc_part",
// 8=>"Les_fondamentaux_(1D)",
// 9=>"Les_fondamentaux_cycle_3",
// 10=>"Orientation_au_collège",
// 11=>"Professionnalisation_formateurs",
// 12=>"Réforme_du_LGT",
// 13=>"Scol_obligatoire_à_partir_de_3_ans",
// 14=>"Sécurisation_des_parcours",
// 15=>"Transfo_voie_professionnelle",);
$prna_A = array(
0=> "-",
"1930" => "1930 : EA-Déontologie de la fonction publique",
"1931" => "1931 : EA-Culture juridique et fondamentaux du droit",
"1932" => "1932 : EA-Valeurs de la république",
"1934" => "1934 : EA-Egalité des chances réussite de tous les élèves",
"1935" => "1935 : EA-Ecole inclusive",
"1936" => "1936 : EA-Mode projet et collectifs de travail",
"1937" => "1937 : EA-Relations & conflits : savoir faire savoir être",
"1938" => "1938 : EA-Prévention des violences éducatives ordinaires",
"19303" => "193C : A-Culture juridique commune",
"19304" => "193D : A-Gestion matérielle, admin, financière comptable",
"19305" => "193E : A-Qualité de vie au travail",
"19306" => "193F : A-Accompagnement des évolutions professionnelles",
"19307" => "193G : EA-GRH de proximité",
"19308" => "193H : EA-Professionnalisation des acteurs RH & formation",
"19309" => "193I : A-Promotion de la santé",
"19310" => "193J : A-Santé et sécurité au travail",
"19311" => "193K : A-Action sociale pour les personnels",
"19312" => "193L : A-Développement professionnel personnels de santé",
"19313" => "193M : A-Evolutions profession. valorisation compétences",
"19314" => "193N : EA-Innovation",
);
$prna_S = array(
0=> "-",
"1920" => "1920 : 2D-Réforme du lycée et du baccalauréat",
"1921" => "1921 : 2D-Transformation de la voie professionnelle",
"1922" => "1922 : 2D-Continuum lycées-enseignement supérieur",
"1923" => "1923 : 2D-Nouveaux programmes LYC, LGT, LP",
"1924" => "1924 : 2D-Numérique et IA dans le cadre pédagogique",
"1925" => "1925 : 2D-Sciences cognitives, mécanismes d'apprentissage",
"1926" => "1926 : 2D-Education artistique et culturelle",
"1927" => "1927 : 2D-Evaluations nationales des élèves",
"1928" => "1928 : 2D-Diversité des élèves dans les apprentissages",
"1929" => "1929 : 2D-Continuum form. initiale - form. continuée",
"19201" => "192A : 2D-Déontologie de la fonction publique",
"19202" => "192B : 2D-Culture juridique et fondamentaux du droit",
"19203" => "192C : 2D-Valeurs de la république",
"19204" => "192D : 2D-Egalité des chances réussite de tous les élèves",
"19205" => "192E : 2D-Ecole inclusive",
"19206" => "192F : 2D-Mode projet et collectifs de travail",
"19207" => "192G : 2D-Relations & conflits : savoir faire savoir être",
"19208" => "192H : 2D-Prévention des violences éducatives ordinaires",
"19209" => "192I : 2D-Promotion de la santé",
"19210" => "192J : 2D-Santé et sécurité au travail",
"19211" => "192K : 2D-Evolutions profession. valorisation compétences",
"19212" => "192L : 2D-Innovation",
);
$prna_P = array(
0=> "-",
"1910" => "1910 : 1D-Ecole maternelle",
"1911" => "1911 : 1D-Apprentissage des fondamentaux à l'école",
"1912" => "1912 : 1D-Déontologie de la fonction publique",
"1913" => "1913 : 1D-Culture juridique et fondamentaux du droit",
"1914" => "1914 : 1D-Valeurs de la république",
"1915" => "1915 : 1D-Egalité des chances réussite de tous les élèves",
"1916" => "1916 : 1D-Ecole inclusive",
"1917" => "1917 : 1D-Mode projet et collectifs de travail",
"1918" => "1918 : 1D-Relations & conflits : savoir faire savoir être",
"1919" => "1919 : 1D-Prévention des violences éducatives ordinaires",
"19101" => "191A : 1D-Numérique et IA dans le cadre pédagogique",
"19102" => "191B : 1D-Sciences cognitives, mécanismes d'apprentissage",
"19103" => "191C : 1D-Education artistique et culturelle",
"19104" => "191D : 1D-Evaluations nationales des élèves",
"19105" => "191E : 1D-Diversité des élèves dans les apprentissages",
"19106" => "191F : 1D-Promotion de la santé",
"19107" => "191G : 1D-Santé et sécurité au travail",
"19108" => "191H : 1D-Evolutions profession. valorisation compétences",
"19109" => "191I : 1D-Innovation",
"19110" => "191J : 1D-Continuum form. initiale - form. continuée",
);
$prna_E = array(
0=> "-",
"1930" => "1930 : EA-Déontologie de la fonction publique",
"1931" => "1931 : EA-Culture juridique et fondamentaux du droit",
"1932" => "1932 : EA-Valeurs de la république",
"1934" => "1934 : EA-Egalité des chances réussite de tous les élèves",
"1935" => "1935 : EA-Ecole inclusive",
"1936" => "1936 : EA-Mode projet et collectifs de travail",
"1937" => "1937 : EA-Relations & conflits : savoir faire savoir être",
"1938" => "1938 : EA-Prévention des violences éducatives ordinaires",
"1939" => "1939 : E-Management et collectif de travail",
"19301" => "193A : E-Modernisation du service public & communication",
"19302" => "193B : E-Evaluation nationale des établissements",
"19307" => "193G : EA-GRH de proximité",
"19308" => "193H : EA-Professionnalisation des acteurs RH & formation",
"19314" => "193N : EA-Innovation",
);
if ($co_tpla=="S") {
  $prios = $prna_S;
} elseif ($co_tpla=="A") {
  $prios = $prna_A;
} elseif ($co_tpla=="E") {
  $prios = $prna_E;
} elseif ($co_tpla=="P") {
  $prios = $prna_P;
} elseif ($co_tpla=="D" or $co_tpla=="C") {
  if (preg_match('/^2S/', $co_orie)) {
    $prios = $prna_S;
  } elseif (preg_match('/^1P/', $co_orie)) {
    $prios = $prna_P;
  } else {
    $prios = array_merge($prna_A,$prna_E, $prna_P, $prna_S);
  }
} else {
  $prios = array();
}

  $form['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['prio_nat'] = array(
    '#type' => 'select',
    '#options' => $prios,
    '#default_value' => (isset($prio_nat))? (int)$prio_nat : '0',
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

    $coo = $form_state->getUserInput('co_omodu');
    $condition = array(
      'co_omodu'  => $coo['co_omodu'],
    );
    $entry = array(
      'prio_nat'  => $form_state->getValue('prio_nat'),
    );
    $row = BbCrudController::load('gbb_gdiof_dafor', $condition);
    if (!empty($row)) {
      $DBWriteStatus = BbCrudController::update('gbb_gdiof_dafor', $entry, $condition);
    } else {
      $DBWriteStatus = BbCrudController::create('gbb_gdiof_dafor', array_merge($condition,$entry));
    }
  }
}
