<?php

namespace Drupal\ap\Controller;
class ApController {
  public function list() {

    $circo_tab = array(
      '0750080E'=>'CIRCONSCRIPTION 1-2-4 LOUVRE',
      '0750078C'=>'CIRCONSCRIPTION 5-6 LUXEMBOURG-SORBONNE',
      '0754742X'=>'CIRCONSCRIPTION 7-8 INVALIDES-ETOILE',
      '0752941P'=>'CIRCONSCRIPTION 9-10A ROCHECHOUART',
      '0750099A'=>'CIRCONSCRIPTION 10B RECOLLETS',
      '0750081F'=>'CIRCONSCRIPTION 11A VOLTAIRE',
      '0750098Z'=>'CIRCONSCRIPTION 11B BASTILLE',
      '0754334D'=>'CIRCONSCRIPTION 12A-3 DAUMESNIL-MARAIS',
      '0750097Y'=>'CIRCONSCRIPTION 12B NATION',
      '0752428G'=>'CIRCONSCRIPTION 13A OLYMPIADES',
      '0750096X'=>'CIRCONSCRIPTION 13B BUTTES AUX CAILLES',
      '0752305Y'=>'CIRCONSCRIPTION 13C AUSTERLITZ',
      '0750094V'=>'CIRCONSCRIPTION 14A MONTPARNASSE',
      '0754462T'=>'CIRCONSCRIPTION 14B-15A MONTSOURIS-VOLONTAIRES',
      '0750079D'=>'CIRCONSCRIPTION 15B GRENELLE',
      '0750093U'=>'CIRCONSCRIPTION 15C CONVENTION',
      '0754461S'=>'CIRCONSCRIPTION 16A AUTEUIL',
      '0750091S'=>'CIRCONSCRIPTION 16B TROCADERO',
      '0752307A'=>'CIRCONSCRIPTION 17A WAGRAM',
      '0750090R'=>'CIRCONSCRIPTION 17B BESSIERE',
      '0750088N'=>'CIRCONSCRIPTION 18A LA CHAPELLE',
      '0750089P'=>'CIRCONSCRIPTION 18B GOUTTE D OR',
      '0753385X'=>'CIRCONSCRIPTION 18C MONTMARTRE',
      '0755240N'=>'CIRCONSCRIPTION 18D JULES JOFFRIN',
      '0750086L'=>'CIRCONSCRIPTION 19A BUTTES CHAUMONT',
      '0754335E'=>'CIRCONSCRIPTION 19B STALINGRAD',
      '0753073H'=>'CIRCONSCRIPTION 19C JAURES',
      '0754396W'=>'CIRCONSCRIPTION 19D COLONEL FABIEN',
      '0750085K'=>'CIRCONSCRIPTION 20A TELEGRAPHE',
      '0750084J'=>'CIRCONSCRIPTION 20B MENILMONTANT',
      '0752306Z'=>'CIRCONSCRIPTION 20C GAMBETTA',
      '0750083H'=>'CIRCONSCRIPTION 20D BELLEVILLE',
      // '0754460R'=>'CIRCONSCRIPTION ASH',
      '0750082G'=>'CIRCONSCRIPTION ASH1',
    );

    // setlocale(LC_CTYPE, 'fr_FR.ISO-8859-1');
    $str  = "<p>Vous trouverez la liste des modules de formation auxquels vous pouvez vous inscrire en cliquant sur votre circonscription de rattachement administratif.</p>";
    $str .= self::gbb_ap_index($circo_tab);
    return array(
      '#title' => 'GAIA animations pédagogiques - 2019/2020',
      '#markup' => $str,
    );
  }

  function gbb_ap_index($tab) {

    $html = "";
    $html .= "<ul>";
    foreach ($tab as $k => $v) {
      $html .= "<li><a href='ap/$k'>$v</a></li>";
    }
    $html .= "</ul>";
    return $html;
  }
  public function circo($circo) {

    \Drupal\Core\Database\Database::setActiveConnection('external');
  $html = "";
  $html .= "<h3>$tab[$circo]</h3>";

  # Liste des modules ayant >2 filtres
  $query = db_select('gbb_gmofl', 'f');
  $query->join('gbb_gmodu', 'm', 'm.co_modu=f.co_modu AND m.co_degre = 1');
  $query->join('gbb_gdisp', 'd', 'd.co_disp=m.co_disp AND d.co_degre = 1');
  $query->condition('d.id_disp', "19D%" , 'LIKE');
  $query->fields('f', array('co_modu'))
        ->groupBy('f.co_modu');

  // $query->addExpression('COUNT(f.co_lieu)', 'ncount');
  // $query->havingCondition('ncount', 2, '>');
  // Réécriture :
  $query->having('COUNT(f.co_lieu) >= :matches', [':matches' => 2]);

  $query->orderBy('m.co_modu', 'ASC');
  $modules_inter = $query->distinct()->execute()->fetchCol();
  // print($query);

  # Liste des modules ayant >= 1 filtre
  $query = db_select('gbb_gmofl', 'f');
  $query->join('gbb_gmodu', 'm', 'm.co_modu=f.co_modu AND m.co_degre = 1');
  $query->join('gbb_gdisp', 'd', 'd.co_disp=m.co_disp AND d.co_degre = 1');
  $query->condition('d.id_disp', "19D%" , 'LIKE');
  $query->condition('f.co_lieu', $circo , 'LIKE');
  $query->condition('m.co_anmo', '', '=');
  $query->condition('d.co_andi', '', '=');
  $query->condition('m.lib', '%math%', 'like');
  $query->fields('m', array('co_modu','lib','lcont'));
  $query->fields('m', array('co_modu','duree_prev','duree_prev'));
  $query->fields('d', array('id_disp'));
  $query->addfield('d', 'lib', 'lib_dispo');
  $query->orderBy('m.co_modu', 'ASC');
  #$query->orderBy('gd.co_tcan', 'ASC');
  $res = $query->distinct()->execute()->fetchAll();

  unset($grand_tableau);
  unset($grand_tableau_inter);
  foreach ($res as $stage) {
    // print($res);
    $grand_tableau[$stage->id_disp]['lib'] = $stage->lib_dispo;
    $grand_tableau[$stage->id_disp]['display'] = True;
    if (!in_array($stage->co_modu,$modules_inter)) {
      $grand_tableau[$stage->id_disp]['module'][$stage->co_modu] = array(
        'lib'=>$stage->lib,
        'lcont'=>$stage->lcont,
        'duree_prev'=>$stage->duree_prev,
      );
    }}
  foreach ($res as $stage) {
    // print($res);
    $grand_tableau_inter[$stage->id_disp]['lib'] = $stage->lib_dispo;
    $grand_tableau_inter[$stage->id_disp]['display'] = True;
    if (in_array($stage->co_modu,$modules_inter)) {
      $grand_tableau_inter[$stage->id_disp]['module'][$stage->co_modu] = array(
        'lib'=>$stage->lib,
        'lcont'=>$stage->lcont,
        'duree_prev'=>$stage->duree_prev,
      );
    }}
  # Liste des modules ayant >= 1 filtre
  $query = db_select('gbb_gmofl', 'f');
  $query->join('gbb_gmodu', 'm', 'm.co_modu=f.co_modu AND m.co_degre = 1');
  $query->join('gbb_gdisp', 'd', 'd.co_disp=m.co_disp AND d.co_degre = 1');
  $query->condition('d.id_disp', "19D%" , 'LIKE');
  $query->condition('f.co_lieu', $circo , 'LIKE');
  $query->condition('m.co_anmo', '', '=');
  $query->condition('d.co_andi', '', '=');
  $query->condition('m.lib', '%langa%', 'like');
  $query->fields('m', array('co_modu','lib','lcont'));
  $query->fields('m', array('co_modu','duree_prev','duree_prev'));
  $query->fields('d', array('id_disp'));
  $query->addfield('d', 'lib', 'lib_dispo');
  $query->orderBy('m.co_modu', 'ASC');
  #$query->orderBy('gd.co_tcan', 'ASC');
  $res = $query->distinct()->execute()->fetchAll();

  foreach ($res as $stage) {
    // print($res);
    $grand_tableau[$stage->id_disp]['lib'] = $stage->lib_dispo;
    $grand_tableau[$stage->id_disp]['display'] = True;
    if (!in_array($stage->co_modu,$modules_inter)) {
      $grand_tableau[$stage->id_disp]['module'][$stage->co_modu] = array(
        'lib'=>$stage->lib,
        'lcont'=>$stage->lcont,
        'duree_prev'=>$stage->duree_prev,
      );
    }}
  foreach ($res as $stage) {
    // print($res);
    $grand_tableau_inter[$stage->id_disp]['lib'] = $stage->lib_dispo;
    $grand_tableau_inter[$stage->id_disp]['display'] = True;
    if (in_array($stage->co_modu,$modules_inter)) {
      $grand_tableau_inter[$stage->id_disp]['module'][$stage->co_modu] = array(
        'lib'=>$stage->lib,
        'lcont'=>$stage->lcont,
        'duree_prev'=>$stage->duree_prev,
      );
    }}
  # Liste des modules ayant >= 1 filtre
  $query = db_select('gbb_gmofl', 'f');
  $query->join('gbb_gmodu', 'm', 'm.co_modu=f.co_modu AND m.co_degre = 1');
  $query->join('gbb_gdisp', 'd', 'd.co_disp=m.co_disp AND d.co_degre = 1');
  $query->condition('d.id_disp', "19D%" , 'LIKE');
  $query->condition('f.co_lieu', $circo , 'LIKE');
  $query->condition('m.co_anmo', '', '=');
  $query->condition('d.co_andi', '', '=');
  $query->condition('m.lib', '%franc%', 'like');
  $query->fields('m', array('co_modu','lib','lcont'));
  $query->fields('m', array('co_modu','duree_prev','duree_prev'));
  $query->fields('d', array('id_disp'));
  $query->addfield('d', 'lib', 'lib_dispo');
  $query->orderBy('m.co_modu', 'ASC');
  #$query->orderBy('gd.co_tcan', 'ASC');
  $res = $query->distinct()->execute()->fetchAll();

  foreach ($res as $stage) {
    // print($res);
    $grand_tableau[$stage->id_disp]['lib'] = $stage->lib_dispo;
    $grand_tableau[$stage->id_disp]['display'] = True;
    if (!in_array($stage->co_modu,$modules_inter)) {
      $grand_tableau[$stage->id_disp]['module'][$stage->co_modu] = array(
        'lib'=>$stage->lib,
        'lcont'=>$stage->lcont,
        'duree_prev'=>$stage->duree_prev,
      );
    }}
  foreach ($res as $stage) {
    // print($res);
    $grand_tableau_inter[$stage->id_disp]['lib'] = $stage->lib_dispo;
    $grand_tableau_inter[$stage->id_disp]['display'] = True;
    if (in_array($stage->co_modu,$modules_inter)) {
      $grand_tableau_inter[$stage->id_disp]['module'][$stage->co_modu] = array(
        'lib'=>$stage->lib,
        'lcont'=>$stage->lcont,
        'duree_prev'=>$stage->duree_prev,
      );
    }}
  # Liste des modules ayant >= 1 filtre
  $query = db_select('gbb_gmofl', 'f');
  $query->join('gbb_gmodu', 'm', 'm.co_modu=f.co_modu AND m.co_degre = 1');
  $query->join('gbb_gdisp', 'd', 'd.co_disp=m.co_disp AND d.co_degre = 1');
  $query->condition('d.id_disp', "19D%" , 'LIKE');
  $query->condition('f.co_lieu', $circo , 'LIKE');
  $query->condition('m.co_anmo', '', '=');
  $query->condition('d.co_andi', '', '=');
  $query->condition('m.lib', '%choral%', 'like');
  $query->fields('m', array('co_modu','lib','lcont'));
  $query->fields('m', array('co_modu','duree_prev','duree_prev'));
  $query->fields('d', array('id_disp'));
  $query->addfield('d', 'lib', 'lib_dispo');
  $query->orderBy('m.co_modu', 'ASC');
  #$query->orderBy('gd.co_tcan', 'ASC');
  $res = $query->distinct()->execute()->fetchAll();

  foreach ($res as $stage) {
    // print($res);
    $grand_tableau[$stage->id_disp]['lib'] = $stage->lib_dispo;
    $grand_tableau[$stage->id_disp]['display'] = True;
    if (!in_array($stage->co_modu,$modules_inter)) {
      $grand_tableau[$stage->id_disp]['module'][$stage->co_modu] = array(
        'lib'=>$stage->lib,
        'lcont'=>$stage->lcont,
        'duree_prev'=>$stage->duree_prev,
      );
    }}
  foreach ($res as $stage) {
    // print($res);
    $grand_tableau_inter[$stage->id_disp]['lib'] = $stage->lib_dispo;
    $grand_tableau_inter[$stage->id_disp]['display'] = True;
    if (in_array($stage->co_modu,$modules_inter)) {
      $grand_tableau_inter[$stage->id_disp]['module'][$stage->co_modu] = array(
        'lib'=>$stage->lib,
        'lcont'=>$stage->lcont,
        'duree_prev'=>$stage->duree_prev,
      );
    }}
  # Liste des modules ayant >= 1 filtre
  $query = db_select('gbb_gmofl', 'f');
  $query->join('gbb_gmodu', 'm', 'm.co_modu=f.co_modu AND m.co_degre = 1');
  $query->join('gbb_gdisp', 'd', 'd.co_disp=m.co_disp AND d.co_degre = 1');
  $query->condition('d.id_disp', "19D%" , 'LIKE');
  $query->condition('f.co_lieu', $circo , 'LIKE');
  $query->condition('m.co_anmo', '', '=');
  $query->condition('d.co_andi', '', '=');
  $query->condition('m.lib', '%math%', 'not like');
  $query->condition('m.lib', '%langa%', 'not like');
  $query->condition('m.lib', '%franc%', 'not like');
  $query->condition('m.lib', '%choral%', 'not like');
  $query->fields('m', array('co_modu','lib','lcont'));
  $query->fields('m', array('co_modu','duree_prev','duree_prev'));
  $query->fields('d', array('id_disp'));
  $query->addfield('d', 'lib', 'lib_dispo');
  $query->orderBy('m.co_modu', 'ASC');
  #$query->orderBy('gd.co_tcan', 'ASC');
  $res = $query->distinct()->execute()->fetchAll();

  foreach ($res as $stage) {
    // print($res);
    $grand_tableau[$stage->id_disp]['lib'] = $stage->lib_dispo;
    $grand_tableau[$stage->id_disp]['display'] = True;
    if (!in_array($stage->co_modu,$modules_inter)) {
      $grand_tableau[$stage->id_disp]['module'][$stage->co_modu] = array(
        'lib'=>$stage->lib,
        'lcont'=>$stage->lcont,
        'duree_prev'=>$stage->duree_prev,
      );
    }}
  foreach ($res as $stage) {
    // print($res);
    $grand_tableau_inter[$stage->id_disp]['lib'] = $stage->lib_dispo;
    $grand_tableau_inter[$stage->id_disp]['display'] = True;
    if (in_array($stage->co_modu,$modules_inter)) {
      $grand_tableau_inter[$stage->id_disp]['module'][$stage->co_modu] = array(
        'lib'=>$stage->lib,
        'lcont'=>$stage->lcont,
        'duree_prev'=>$stage->duree_prev,
      );
    }}
  if ( $circo != "0754460R") {
    $html  .= self::gbb_ap_print("Stages proposés par la circonscription", "", $grand_tableau,1);
  };
  if ( $circo == "0750086L" || $circo == "0754335E" || $circo == "0753073H" || $circo == "0754396W") {
    $html  .= self::gbb_ap_print("Stages académiques, partenaires et pôle 19 retenus par la circonscription", "", $grand_tableau_inter,1);
  } elseif ( $circo != "0754460R") {
    $html  .= self::gbb_ap_print("Stages académiques et partenaires retenus par la circonscription", "", $grand_tableau_inter,2);
  };
  // return array(
      // '#title' => 'Demo Module',
      // '#markup' => $html,
    // );
    $circo_tab = array(
      '0750080E'=>'CIRCONSCRIPTION 1-2-4 LOUVRE',
      '0750078C'=>'CIRCONSCRIPTION 5-6 LUXEMBOURG-SORBONNE',
      '0754742X'=>'CIRCONSCRIPTION 7-8 INVALIDES-ETOILE',
      '0752941P'=>'CIRCONSCRIPTION 9-10A ROCHECHOUART',
      '0750099A'=>'CIRCONSCRIPTION 10B RECOLLETS',
      '0750081F'=>'CIRCONSCRIPTION 11A VOLTAIRE',
      '0750098Z'=>'CIRCONSCRIPTION 11B BASTILLE',
      '0754334D'=>'CIRCONSCRIPTION 12A-3 DAUMESNIL-MARAIS',
      '0750097Y'=>'CIRCONSCRIPTION 12B NATION',
      '0752428G'=>'CIRCONSCRIPTION 13A OLYMPIADES',
      '0750096X'=>'CIRCONSCRIPTION 13B BUTTES AUX CAILLES',
      '0752305Y'=>'CIRCONSCRIPTION 13C AUSTERLITZ',
      '0750094V'=>'CIRCONSCRIPTION 14A MONTPARNASSE',
      '0754462T'=>'CIRCONSCRIPTION 14B-15A MONTSOURIS-VOLONTAIRES',
      '0750079D'=>'CIRCONSCRIPTION 15B GRENELLE',
      '0750093U'=>'CIRCONSCRIPTION 15C CONVENTION',
      '0754461S'=>'CIRCONSCRIPTION 16A AUTEUIL',
      '0750091S'=>'CIRCONSCRIPTION 16B TROCADERO',
      '0752307A'=>'CIRCONSCRIPTION 17A WAGRAM',
      '0750090R'=>'CIRCONSCRIPTION 17B BESSIERE',
      '0750088N'=>'CIRCONSCRIPTION 18A LA CHAPELLE',
      '0750089P'=>'CIRCONSCRIPTION 18B GOUTTE D OR',
      '0753385X'=>'CIRCONSCRIPTION 18C MONTMARTRE',
      '0755240N'=>'CIRCONSCRIPTION 18D JULES JOFFRIN',
      '0750086L'=>'CIRCONSCRIPTION 19A BUTTES CHAUMONT',
      '0754335E'=>'CIRCONSCRIPTION 19B STALINGRAD',
      '0753073H'=>'CIRCONSCRIPTION 19C JAURES',
      '0754396W'=>'CIRCONSCRIPTION 19D COLONEL FABIEN',
      '0750085K'=>'CIRCONSCRIPTION 20A TELEGRAPHE',
      '0750084J'=>'CIRCONSCRIPTION 20B MENILMONTANT',
      '0752306Z'=>'CIRCONSCRIPTION 20C GAMBETTA',
      '0750083H'=>'CIRCONSCRIPTION 20D BELLEVILLE',
      // '0754460R'=>'CIRCONSCRIPTION ASH',
      '0750082G'=>'CIRCONSCRIPTION ASH1',
      '0750087M'=>'CIRCONSCRIPTION ASH2',
      '0755967D'=>'CIRCONSCRIPTION ASH3',
    );

    return array(
      '#title' => 'Demo Module',
      '#theme' => 'apcirco',
      '#inter' => $grand_tableau_inter,
      '#tab' => $grand_tableau,
      '#circo_name' => $circo_tab[$circo],
      '#circo' => $circo,
    );
  }
function gbb_ap_print($title,$chapo,$tab,$tag) {
  $html = "<h2>$title</h2>";
  $html .= "<p>$chapo</p>";

  foreach ($tab as $disp  => $data) {
    if (isset($data['module']) && $data['display']) {
      $html .= "<p>";
      $html .= "<span class=\"titredisp\">";
      $html .= $disp;
      // $html .= "<span class=\"togg titre\" onclick=\"$('#$disp-$tag').toggle('slow');\">";
      // $html .= "<span class=\"togg titre\" onclick=\"myToggle('$disp-$tag')\">";
      $html .= "<span class=\"togg titre\" onclick=\"myToggle()\">";
      $html .= " ". $data['lib'];
      $html .= "</span>";
      $html .= "</span>";
      $html .= "</p>";
      $html .= "<div id=\"$disp-$tag\" style=\"display: none;\">";
      foreach ($data['module'] as $co_modu => $m) {
        $html .= "<div class=\"listeAp\">";
        $html .= "<p>$co_modu ".$m['lib']."<br/>";
        $html .= "<span class=\"module\">".$m['lcont']."</span>";
        $html .= "</p>";
        $html .= "</div>";
      }
      $html .= "</div>";
    }
  }
  return $html;
}
}
