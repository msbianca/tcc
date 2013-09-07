<?php

/**
 * Classe que contém os métodos utilitários
 *
 * @author aLeX
 */
class Util {

    public static function montarLink($texto) {
        if (!is_string($texto))
            return $texto;

        $er = "/(http(s)?:\/\/(www|.*?\/)?((\.|\/)?[a-zA-Z0-9&%_?=-]+)+)/i";
        preg_match_all($er, $texto, $match);

        foreach ($match[0] as $link) {
            $link = strtolower($link);
            $link_len = strlen($link);

            //troca "&" por "&amp;", tornando o link válido pela W3C
            $web_link = str_replace("&", "&amp;", $link);

            $texto = str_ireplace($link, "<a href=\"" . $web_link . "\" target=\"_blank\" title=\"" . $web_link . "\" rel=\"nofollow\">" . (($link_len > 60) ? substr($web_link, 0, 25) . "..." . substr($web_link, -15) : $web_link) . "</a>", $texto);
        }

        return $texto;
    }

}

?>
