<?php

namespace GoodmotionStarter\inc\cookies;

/** RGPD */

add_action(
  'wp_head',
  function () {
    echo '<script type="text/javascript">
      var _gdpr = _gdpr || [];
      var _gdpr_messages = {
        fr: {
        banner_title: "' . __("Information sur l'utilisation de cookies sur le site.", "goodmotion-theme") . '",
        modal_intro_txt:
        "",
        modal_info_txt:
        "' . __("Vous devez accepter ou refuser les cookies, puis sauvegarder votre choix.", "goodmotion-theme") . '",
        alert_text:
        "' . __("En poursuivant votre navigation, vous acceptez l\'utilisation de services tiers pouvant installer des cookies.", "goodmotion-theme") . '",
        banner_ok_bt: "' . __("Tout accepter", "goodmotion-theme") . '",
        banner_custom_bt: "' . __("Personnaliser les cookies", "goodmotion-theme") . '",
        modal_header_txt: "' . __("Centre de préférences", "goodmotion-theme") . '",
        close_modale_label: "' . __("Fermer la fenêtre", "goodmotion-theme") . '",
        service_accept: "' . __("Activer", "goodmotion-theme") . '",
        service_accept_all: "' . __("Activer tous les services", "goodmotion-theme") . '",
        service_bloc_all: "' . __("Bloquer tous les services", "goodmotion-theme") . '",
        service_activated: "' . __("Service activé", "goodmotion-theme") . '",
        service_blocked: "' . __("Service bloqué", "goodmotion-theme") . '",
        modal_valid: "' . __("Valider les préférences", "goodmotion-theme") . '",
        ads: "' . __("Publicités", "goodmotion-theme") . '",
        stats: "' . __("Statistiques", "goodmotion-theme") . '",
        others: "' . __("Autres services", "goodmotion-theme") . '",
        mask_text_start: "' . __("Le service", "goodmotion-theme") . '",
        mask_text_end: "' . __("est désactivé", "goodmotion-theme") . '",
        activate: "' . __("activer", "goodmotion-theme") . '",
        deactivate: "' . __("désactiver", "goodmotion-theme") . '",
      },
    };
    var _gdpr_lang = "fr";
    window._gdpr_options = {
      keepCookies: [],
      types: ["ads", "stats", "video"],
      optout: true,
    };
        // use script
        _gdpr.push([
          {
            type: "stats",
            label: "' . __("Mesure d’audience et de performance", "goodmotion-theme") . '",
            name: "mesureStats",
            description: "' . __("Ces services collectent la performance, le volume et le comportement du trafic du site.", "goodmotion-theme") . '",
          },
          [
            function () {
              (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,\'script\',\'https://www.google-analytics.com/analytics.js\',\'ga\');

                ga(\'create\', \'UA-168156136-1\', \'auto\');
                ga(\'send\', \'pageview\');
            },
          ],
        ]);
      </script>';
  },
  2
);
