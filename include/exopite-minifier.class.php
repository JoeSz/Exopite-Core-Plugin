<?php

class Exopite_Minifier {

    /**
     * Minify and compress JavaScript
     *
     * @link https://github.com/Morron-by-nature/PHP-CODE_javascript-minify-compression
     * @param  string $buffer JavaScript file content
     * @return string         Minified and compresses JavaScript content
     */
    public static function minify_js( $buffer ) {

        //---------------------------------------------------------------------------------------------------------
        //These are 112 lines off code that work together also works with mootools and Joomla and drupal and other cms websites.
        //Tested it on 800.000 lines of code and comments. works fine.
        //This one selects multiple parenthetical like ( abc(/*nn*/('/*xvx*/'))"// testing line") and protect them as non comments.
        //16-01-2016..! This is the code with the comments in it.!!!!
        //----------------------------------------------------------------//-----------------------------------------
        $buffer = preg_replace("/(\*\/\s*)\/\/(?!(\*\/|[^\r\n]*?[\\\\n\\\\r]+\s*\"\s*\+|[^\r\n]*?[\\\\n\\\\r]+\s*\'\s*\+))[^\n\r\;]*?[^\;]\s*[\n\r]/", "$1\n", $buffer);
        do {$buffer = preg_replace("/(http(s)?\:)([^\r\n]*?)(\/\/)/", "$1$3qDdXX", $buffer, 1, $count);} while ($count);
        do {$buffer = preg_replace("/(^^\s*\/)(\/).*/", "\n", $buffer, 1, $count);} while ($count);
        $buffer = preg_replace("/([\r\n]+?\s*|\,\s*|\;\s*|\|\s*|\)\s*|\+\s*|\&\s*|\{\s*|\}\s*|\]\s*|\[\s*|\+\s*|\'\s*|\"\s*|\:\s*|-\s*)((\/)(\/)+)([^\r\n\'\"]*?[nte]'[a-z])*?(?!([^\r\n]*?)([\'\"]|[\\\\]|\*\/|[=]+\s*\";|[=]+\s*\';)).*/", "$1\n", $buffer);
        $buffer = preg_replace("/(^^\s*\/\*)(?!([\'\"]))[\s\S]*?(\*\/)/", "\n \n", $buffer);
        $buffer = preg_replace("/(\|\|\s*|=\s*|[\n\r]|\;\s*|\,\s*|\{\s*|\}\s*|\+\s*|\?\s*)((?!([\'\"]))\/\*)(?!(\*\/))[\s\S]*?(\*\/)/", "$1\n", $buffer);
        $buffer = preg_replace("/(\;\s*|\,\s*|\{\s*|\}\s*|\+\s*|\?\s*|[\n\r]\s*)((?!([\'\"]))\/\*)(?!(\*\/))[\s\S]*?(\*\/)/", "$1\n", $buffer);
        //Remove: ) /* non-empty*//*xxx*/)
        do {$buffer = preg_replace('/([^\/\"\'\*a-zA-Z0-9\>])\/\*(?!(\*\/))[^\n\r@]*?\*\/(?=([\/\"\'\\\\\*a-zA-Z0-9\>\s=\)\(\,:;\.\}\{\|\]\[]))/', "$1", $buffer, 1, $count);} while ($count);
        $buffer = preg_replace("/([\;\n\r]\s*)\/\/.*/", "$1\n", $buffer);
        $buffer = preg_replace("/(\/\s\/)([g][\W])/", "ZUQQ$2", $buffer);
        $buffer = preg_replace("/\\\\n/", "AQerT", $buffer);
        $buffer = preg_replace("/\\\\r/", "BQerT", $buffer);
        ////---------------------------------------------------------------------------------------------------------
        // Remove all extra new lines after [ and \
        $buffer = preg_replace("/([^\*])(\*|[\r\n]|\'|\"|\,|\+|\{|;|\(|\)|\[|\]|\{|\}|\?|[^p|s]:|\&|\%|[^\\\\][a-m-o-u-s-zA-Z]|\||-|=|[0-9])(\s*)(?!([^=\\\\\&\/\"\'\^\*:]))(\/)(\/)+(?!([\r\n\*\+\"]*?([^\r\n]*?\*\/|[^\r\n]*?\"\s*\+|([^\r\n]*?=\";))))([^\n\r]*)([^;\"\'\{\(\}\,]\s*[\\\\\[])(?=([\r\n]+))/", "$1$2$3", $buffer);

        // /* followed by (not new line but) ... */ ... /* ... till */
        $buffer = preg_replace("/((([\r\n]\s*)(\/\*[^\r\n]*?\*\/(?!([^\n\r]*?\"\s*\+)))([^\n\r]*?\/\*[^\n\r]*?\*\/(?!([^\n\r]*?\"\s*\+))[^\n\r]*?\/\*[^\n\r]*?\*\/(?!([^\n\r]*?\"\s*\+)))+)+(?!([\*]))(?=([^\n\r\/]*?\/\/\/)))/", "$3", $buffer);
        // (slash slash) remove everything behinde it not if its followed by */ and /n/r or " + and /n/r
        $buffer = preg_replace("/([\r\n]+?\s*)((\/)(\/)+)(?!([^\r\n]*?)([\\\\]|\*\/|[=]+\s*\";|[=]+\s*\';)).*/", "$1\n", $buffer);
        // slash slash star between collons protect like: ' //* ' by TDdXX
        $buffer = preg_replace("/(\'\s*)(\/\/\*)([^\r\n\*]*?(?!(\*\/))(\'))/", "$1TDdXX$3", $buffer);
        // slash slash star between collons protect like: " //* " by TDdXX
        $buffer = preg_replace("/(\"\s*)(\/\/\*)([^\r\n\*]*?(?!(\*\/))(\"))/", "$1TDdXX$3", $buffer);
        // slash slash star between collons protect like: ' //* ' by TDdXX
        $buffer = preg_replace("/(\'\s*)(\/\*)([^\r\n\*]*?(?!(\*\/))(\'))/", "$1pDdYX$3", $buffer);
        // slash slash star between collons protect like: " //* " by TDdXX
        $buffer = preg_replace("/(\"\s*)(\/\*)([^\r\n\*]*?(?!(\*\/))(\"))/", "$1pDdYX$3", $buffer);
        // in regex star slash protect by: ODdPK
        $buffer = preg_replace("/(\,\s*)(\*\/\*)(\s*[\}\"\'\;\)])/", "$1RDdPK$3", $buffer); // , */* '
        $buffer = preg_replace('/(\n|\r|\+|\&|\=|\|\||\(|[^\)]\:[^\=\,\/\$\\\\\<]|\(|return(?!(\/[a-zA-Z]+))|\!|\,)(?!(\s*\/\/|\n))(\s*\/)([^\]\)\}\*\;\,gi\.]\s*)([^\/\n]*?)(\*\/)/', '$1$4$5$6ODdPK', $buffer);
        //// (slash r) (slash n) protect if followed by " + and new line
        $buffer = preg_replace("/[\/][\/]+(AQerTBQerT)(\s*[\"]\s*[\+])/", "WQerT", $buffer);
        $buffer = preg_replace("/[\/][\/]+(\*\/AQerTBQerT)(\s*[\"]\s*[\+])/", "YQerT", $buffer);
        // Html Text protection!
        $buffer = preg_replace("/([\r\n]\s*\/\/)[^\r\n]*?\/\*(?=(\/))[^\r\n]*?([\r\n])/", "$1 */$3", $buffer);
        $buffer = preg_replace("/([\)]|[^\/|\\\\|\"])(\/\*)(?=([^\r\n]*?[\\\\][rn]([\\\\][nr])?\s*\"\s*\+\s*(\n|\r)?\s*\"))/", "$1pDdYX", $buffer);
        $buffer = preg_replace('/([\"]\s*[\,\+][\r\n]\s*[\"])(\s*\/\/)((\/\/)|(\/))*/', '$1qDdXX', $buffer);
        $buffer = preg_replace('/([\"]\s*[\,\+][\r\n]\s*[\"](qDdXX))[\\\\]*(\s*\/\/)*((\/\/)|(\/))*/', '$1', $buffer);
        // started by new line slash slash remove all not followed by */ and new line!
        $buffer = preg_replace("/([\r\n]\s*)(?=([^\r\n\*\,\:\;a-zA-Z\"]*?))(\/)+(\/)[^\r\n\/][^\r\n\*\,]*?[\*]+(?!([^\r\n]*?(([^\r\n]*?\/|\"\s*\)\s*\;|\"\s*\;|\"\s*\,|\'\s*\)\s*\;|\'\s*\;|\'\s*\,))))[^\r\n]*(?!([\/\r\n]))[^\r\n]*/", "$1", $buffer);
        // removes all *.../ achter // leaves the ( // /* staan en */ ) 1 off 2
        $buffer = preg_replace("/([\r\n](\/)*[^:\;\,\.\+])(\/\/[^\r\n]*?)(\*)?([^\r\n]+?)(\*)+([^\r\n\*\/])+?(\/[^\*])(?!([^\r\n]*?((\"\s*\)\s*\;|\"\s*\;|\"\s*\,|\'\s*\)\s*\;|\'\s*\;|\'\s*\,))))/", "$1$3$7$8", $buffer);
        // removes all /* after // leaves the ( // */ staan ) 2 off 2
        do {$buffer = preg_replace("/([\r\n])((\/)*[^:\;\,\.\+])(\/\/[^\r\n]*?)(\*)?([^\r\n]+?)(\/|\*)([^\r\n]*?)(\*)[\r\n]/", "$1", $buffer, 1, $count);} while ($count);
        ////---------------------------------------------------------------------------------------------------------
        // removes all (/* and */) combinations after // and everything behinde it! but leaves  ///* */ or example. ///*//*/ one times.
        $buffer = preg_replace("/(((([\r\n](?=([^:;,\.\+])))(\/)+(\/))(\*))([^\r\n]*?)(\/\*)*([^\r\n])*?(\*\/)(?!([^\r\n]*?((\"\s*\)\s*\;|\"\s*\;|\"\s*\,|\'\s*\)\s*\;|\'\s*\;|\'\s*\,))))(((?=([^:\;\,\.\+])))(\/)*([^\r\n]*?)(\*|\/)?([^\r\n]*?)(\/\*)([^\r\n])*?(\*\/)(?!([^\r\n]*?((\"\s*\)\s*\;|\"\s*\;|\"\s*\,|\'\s*\)\s*\;|\'\s*\;|\'\s*\,)))))*)+[^\r\n]*/", "$2$7$9$10$11$12", $buffer);
        // removes /* ... followed by */ repeat even pairs till new line!
        $buffer = preg_replace("/(\/\*[\r\n]\s*)(?!([^\/<>;:%~`#@&-_=,\.\$\^\{\[\(\|\)\*\+\?\'\"\a-zA-Z0-9]))(((\/\*)[^\r\n]*?(\*\/)?[^\r\n]*?(\/\*)[^\r\n]*?(\*\/))*((\/\*)[^\r\n]*?(\*\/)))+(?!([^\r\n]*?(\*\/|\/\*)))[^\r\n]*?[\r\n]/", "\n", $buffer);
        ////---------------------------------------------------------------------------------------------------------
        // (Mark) Regex Find all "  Mark with = AwTc  and  CwRc // special cahacers are:  . \ + * ? ^ $ [ ] ( ) { } < > = ! | : " '
        $buffer = preg_replace("/(?!([\r\n]))([^a-zA-Z0-9]\+|\?|&|\=|\|\||\!|\(|,|return(?!(\/[a-zA-Z]+))|[^\)]\:)(?!(\s*\/\/|\n|\/\*[^\r\n\*]*?\*\/))(\s*\/([\*\^]?))(?!([\r\n\*\/]|[\*]))(?!(\<\!\-\-))(([^\^\]\)\}\*;,g&\.\"\']?\s*)(?=([\]\)\}\*;,g&\.\/\"\']))?)(([^\r\n]*?)(([\w\W])([\*]?\/\s*)(\})|([^\\\\])([\*]?\/\s*)(\))|([\w\W])([\*]?\/\s*)([i][g]?[\W])|([\w\W])([\*]?\/\s*)([g][i]?[\W])|([\w\W])([\*]?\/\s*)(?=(\,))|([^\\\\]|[\/])([\*]?\/\s*)(;)|([\w\W])([\*]?\/\:\s)(?!([@\]\[\)\(\}\{\.,#%\+-\=`~\*&\^;\:\'\"]))|([^\\\\])([\*]?\/\s*)(\.[^\/])|([^\\\\])([\*]?\/\s*)([\r\n]\s*[;\.,\)\}\]]\s*[^\/]|[\r\n]\s*([i][g]?[\W])|[\r\n]\s*([g][i]?[\W])))|([^\\\\])([\*]?\/\s*)([;\.,\)\}\]]\s*[^\/]|([i][g]?[\W])|([g][i]?[\W])))/", "$2$3$5AwTc$7$8$10$13$15$18$21$24$27$30$33$36$39$44CwRc$16$17$19$20$22$23$25$26$28$31$32$34$35$37$38$40$41$45$46", $buffer);


        // Remove all extra new lines after [ and \
        $buffer = preg_replace("/([^;\"\'\{\(\}\,\/]\s*[^\/][\\\\\[]\s?)\s*([\r\n]+)/", "$1", $buffer);
        $buffer = preg_replace("/([\|\[])\s*([\|\]])/", "$1$2", $buffer);
        // (star slash) or (slash star) 1 sentence! Protect! With pDdYX and ODdPK
        do {$buffer = preg_replace('/(AwTc)([^\r\nC]*?)(\/\*)(?=([^\r\n]*?CwRc))/', '$1$2pDdYX', $buffer, 1, $count);} while ($count);
        do {$buffer = preg_replace('/(AwTc)([^\r\nC]*?)(\*\/)(?=([^\r\n]*?CwRc))/', '$1$2ODdPK', $buffer, 1, $count);} while ($count);
        // (slash slash) 1 sentence! Protect with: qDdXX
        do {$buffer = preg_replace('/(AwTc)([^\r\nC]*?)(\/\/)(?=([^\r\n]*?CwRc))/', '$1$2qDdXX', $buffer, 1, $count);} while ($count);

        //---------------------------------------------------------------------------------------------------------
        // DEZE WERKT !! multiple parentheticals counting for even ones!
         $buffer = preg_replace("/([^\(\/\"\']\s*)(?!\(\s*function)((\()(?=([^\n\r\)]*?[\'\"]))(?!([^\r\n]*?\"\s*\<[^\r\n]*?\>\s*\"|[^\r\n]*?\"\s*\\\\\s*\"|[^\r\n]*?\"\s*\[[^\r\n]*?\]\s*\"))((?>[^()]+)|(?2))*?\))(?!(\s*\"\s*\;|\s*\'\s*\;|\s*\/|\s*\)|\s*\"|[^\n\r]*?\"\s*\+\s*(\n|\r)?\s*\"))/", "$1 /*Yu*/ $2 /*Zu*/ ", $buffer);

        // this one is  SINGLE parentheticals pair.
        //     $buffer = preg_replace("/([^\(\/\"\']\s*)((\()(?=([^\n\r\)]*?[\'\"]))(?!(function|\)|[^\r\n]*?\"\s*\+[^\r\n]*?\+\s*\"|[^\r\n]*?\"\s*\<[^\r\n]*?\>\s*\"|[^\r\n]*?\"\s*\\\\\s*\"|[^\r\n]*?\"\s*\[[^\r\n]*?\]\s*\"))([^()]*?\)))(?!(\s*\"\s*\;|\s*\'\s*\;|\s*\/|\s*\)|\s*\"|[^\n\r]*?\"\s*\+\s*(\n|\r)?\s*\"))/", "$1 /*Yu*/ $2 /*Zu*/ ", $buffer);

        // (slash slash) 1 sentence! Protect with: qDdXX
        do {$buffer = preg_replace('/(\/\*Yu\*\/)([^\r\n]*?)(\/)(\/)(?=([^\r\n]*?\/\*Zu\*\/))/', '$1$2qDdXX', $buffer, 1, $count);} while ($count);
        do {$buffer = preg_replace("/(\/\*Yu\*\/)([^\n\r\'\"]*?[\"\'])([^\n\r\)]*?)(\/\*)([^\n\r\'\"\)]*?[\"\'])([^\n\r]*?\/\*Zu\*\/)/", "$1$2$3pDdYX$5$6", $buffer, 1, $count);} while ($count);
        do {$buffer = preg_replace("/(\/\*Yu\*\/)([^\n\r\'\"]*?[\"\'])([^\n\r\)]*?)(\*\/)([^\n\r\'\"\)]*?[\"\'])([^\n\r]*?\/\*Zu\*\/)/", "$1$2$3ODdPK$5$6", $buffer, 1, $count);} while ($count);

        //---------------------------------------------------------------------------------------------------------
        // (slash slash) 2 sentences! Protect ' and "
        do {$buffer = preg_replace("/(=|\+|\(|[a-z]|\,)(\s*)(\")([^\r\n\;\/\'\)\,\]\}\*]*?)(\/)(\/)([^\r\n\;\"\*]*?)(\")/", "$1$2$3$4qDdXX$7$8", $buffer, 1, $count);} while ($count);
        do {$buffer = preg_replace("/(=|\+|\(|[a-z]|\,)(\s*)(\')([^\r\n\;\/\'\)\,\]\}\*]*?)(\/)(\/)([^\r\n\*\;\']*?)(\')/", "$1$2$3$4qDdXX$7$8", $buffer, 1, $count);} while ($count);
        // (slash slash) 2 sentences! Protect slash slash between ' and "
        do {$buffer = preg_replace("/(\"[^\r\n\;]*?)(\/)(\/)([^\r\n\"\;]*?([\"]\s*(\;|\)|\,)))/", "$1qDdXX$4", $buffer, 1, $count);} while ($count);
        do {$buffer = preg_replace("/(\'[^\r\n\;]*?)(\/)(\/)([^\r\n\'\;]*?([\']\s*(\;|\)|\,)))/", "$1qDdXX$4", $buffer, 1, $count);} while ($count);
        //---------------------------------------------------------------------------------------------------------
        // Remove all slar slash achter \n
        $buffer = preg_replace("/([\n\r])([^\n\r\*\,\"\']*?)(?=([^\*\,\:\;a-zA-Z\"]*?))(\/)(\/)+(?=([^\n\r]*?\*\/))([^\n\r]*?(\*\/)).*/", "$1$4$5 $8", $buffer);
        do {$buffer = preg_replace("/([\r\n]\s*)((\/\*(?!(\*\/)))([^\r\n]+?)(\*\/))(?!([^\n\r\/]*?(\/)(\/)+\*))/", "$1$3$6", $buffer, 1, $count);} while ($count);
        $buffer = preg_replace("/([\n\r]\/)(\/)+([^\n\r]*?)(\*\/)([^\n\r]*?(\*\/))(?!([^\n\r]*?(\*\/)|[^\n\r]*?(\/\*))).*/", "$1/ $4", $buffer);
        do {$buffer = preg_replace("/([\n\r]\s*\/\*\*\/)([^\n\r=]*?\/\*[^\n\r]*?\*\/)(?=([\n\r]|\/\/))/", "$1", $buffer, 1, $count);} while ($count);
        $buffer = preg_replace("/([\n\r]\s*\/\*\*\/)([^\n\r=]*?)(\/\/.*)/", "$1$2", $buffer);
        // Remove all slash slash achter = '...'; //......
        do {$buffer = preg_replace("/(\=\s*)(?=([^\r\n\'\"]*?\'[^\n\r\']*?\'))([^\n\r;]*?[;]\s*)(\/\/[^\r\n][^\r\n]*)[\n\r]/", "$1$3", $buffer, 1, $count);} while ($count);
        // protect slash slash '...abc//...abc'!
        do {$buffer = preg_replace("/(\=)(\s*\')([^\r\n\'\"]*?)(\/)(\/)([^\r\n]*?[\'])/", "$1$2$3qDdXX$6", $buffer, 1, $count);} while ($count);
        //(slash star) or (star slash) : no dubble senteces here! Protect with: pDdYX and ODdPK
        do {$buffer = preg_replace("/(\"[^\r\n\;\,\"]*?)(\/)(\*)(?!([YZ]u\*\/))([^\r\n;\,\"]*?)(\")/", "$1pDdYX$5$6", $buffer, 1, $count);} while ($count);   // open
        do {$buffer = preg_replace("/([^\"]\"[^\r\n\;\/\,\"]*?)(\s*)(\*)(\/)([^\r\n;\,\"=]*?)(\")/", "$1$2ODdPK$5$6", $buffer, 1, $count);} while ($count); // close
        do {$buffer = preg_replace("/(\'[^\r\n\;\,\']*?)(\/)(\*)(?!([YZ]u\*\/))([^\r\n;\,\']*?)(\')/", "$1pDdYX$5$6", $buffer, 1, $count);} while ($count);   // open
        do {$buffer = preg_replace("/(\'[^\r\n\;\/\,\']*?)(\s*)(\*)(\/)([^\r\n;\,\']*?)(\')/", "$1$2ODdPK$5$6", $buffer, 1, $count);} while ($count); // close
        // protect star slash '...abc*/...abc'!
        do {$buffer = preg_replace("/(\'[^\r\n\;\,\']*?)(\*)(\/)([^\r\n;\,\']*?)(\')(?!([^\n\r\+]*?[\']))/", "$1ODdPK$4$5", $buffer, 1, $count);} while ($count);
        // protect star slash '...abc*/...abc'!
        do {$buffer = preg_replace("/(\"[^\r\n\;\,\"]*?)(\*)(\/)([^\r\n;\,\"]*?)(\")(?!([^\n\r\+]*?[\"]))/", "$1ODdPK$4$5", $buffer, 1, $count);} while ($count);
         //---------------------------------------------------------------------------------------------------------
        //// \n protect
        do {$buffer = preg_replace("/(=\s*\"[^\n\r\"]*?)(\/\/)(?=([^\n\r]*?\"\s*;))/", "$1qDdXX", $buffer, 1, $count);} while ($count);
        do {$buffer = preg_replace("/(=\s*\"[^\n\r\"]*?)(\/\*)(?!([YZ]u\*\/))(?=([^\n\r]*?\"\s*;))/", "$1pDdYX", $buffer, 1, $count);} while ($count);
        do {$buffer = preg_replace("/(=\s*\"[^\n\r\"]*?)(\*\/)(?=([^\n\r]*?\"\s*;))/", "$1ODdPK", $buffer, 1, $count);} while ($count);
        do {$buffer = preg_replace("/(=\s*\'[^\n\r\']*?)(\/\/)(?=([^\n\r]*?\'\s*;))/", "$1qDdXX", $buffer, 1, $count);} while ($count);
        do {$buffer = preg_replace("/(=\s*\'[^\n\r\']*?)(\/\*)(?!([YZ]u\*\/))(?=([^\n\r]*?\'\s*;))/", "$1pDdYX", $buffer, 1, $count);} while ($count);
        do {$buffer = preg_replace("/(=\s*\'[^\n\r\']*?)(\*\/)(?=([^\n\r]*?\'\s*;))/", "$1ODdPK", $buffer, 1, $count);} while ($count);
        //---------------------------------------------------------------------------------------------------------
        // (Slash Slash) alle = " // " and = ' // ' replace by! qDdXX
        do {$buffer = preg_replace("/(\=|\()(\s*\")([^\r\n\'\"]*?[\'][^\r\n\'\"]*?)(\/)(\/)([^\r\n\'\"]*?[\'])(\s*\'[^\r\n\'\"]*?)(\/\/|qDdXX)?([^\r\n\'\"]*?[\'][^\r\n\'\"]*?[\"])(?!(\'\)|\s*[\)]?\s*\+|\'))/", "$1$2$3qDdXX$6$7qDdXX$9$10", $buffer, 1, $count);} while ($count);
        do {$buffer = preg_replace("/(\=|\()(\s*\')([^\r\n\'\"]*?[\"][^\r\n\'\"]*?)(\/)(\/)([^\r\n\'\"]*?[\"])(\s*\"[^\r\n\'\"]*?)(\/\/|qDdXX)?([^\r\n\'\"]*?[\"][^\r\n\'\"]*?[\'])(?!(\'\)|\s*[\)]?\s*\+|\'))/", "$1$2$3qDdXX$6$7qDdXX$9$10", $buffer, 1, $count);} while ($count);
        //---------------------------------------------------------------------------------------------------------
        // (slash slash) Remove all also , or + not followed by */ and newline
        $buffer = preg_replace("/([^\*])(\*|[\r\n]|[^\\\\]\'|[^\\\\]\"|\,|\+|\{|;|\(|\)|\[|\]|\{|\}|\?|[^p|s]:|\&|\%|[^\\\\][a-m-o-u-s-zA-Z]|\||-|=|[0-9])(\s*)(?!([^=\\\\\&\/\"\'\^\*:]))(\/)(\/)+(?!([\r\n\*\+\"]*?([^\r\n]*?\*\/|[^\r\n]*?\"\s*\+|([^\r\n]*?=\";)))).*/", "$1$2$3", $buffer);
        // (slash slash star slash) Remove everhing behinde it not followed by */ or new line
        $buffer = preg_replace("/(\/\/\*\/)(?!([\r\n\*\+\"]*?([^\r\n]*?\*\/|[^\r\n]*?\"\s*\+|([^\r\n]*?=\";)))).*/", "", $buffer);
        // Remove almost all star comments except colon/**/
        $buffer = preg_replace("/(?!([^\n\r]*?[\'\"]))(\s*<!--.*-->)(?!(<\/div>))[^\n\r]*?.*/","$2$4", $buffer);
        $buffer = preg_replace("/([\n\r][^\n\r\*\,\"\']*?)(?=([^\*\,\:\;a-zA-Z\"]*?))(\/)(\/)+(?!([\r\n\*\+\"]*?([^\r\n]*?\*\/|[^\r\n]*?\"\s*\+|([^\r\n]*?=\";)))).*/", "$1", $buffer);
        $buffer = preg_replace("/(?!([^\n\r]*?[\'\"]))(\s*<!--.*-->)(?!(<\/div>))[^\n\r]*?(\*\/)?.*/","", $buffer);
        $buffer = preg_replace("/(<!--.*?-->)(?=(\s*<\/div>))/","", $buffer);
        //---------------------------------------------------------------------------------------------------------
        // Restore all
        $buffer = preg_replace("/qDdXX/", "//", $buffer);  // Restore //
        $buffer = preg_replace("/pDdYX/", "/*", $buffer);   // Restore
        $buffer = preg_replace("/ODdPK/", "*/", $buffer);   // Restore
        $buffer = preg_replace("/RDdPK/", "*/*", $buffer);   // Restore
        $buffer = preg_replace("/TDdXX/", "//*", $buffer);   // Restore */
        $buffer = preg_replace('/WQerT/', '\\\\r\\\\n" +', $buffer);   // Restore \r\n" +
        $buffer = preg_replace('/YQerT/', '//*/\\\\r\\\\n" +', $buffer);   // Restore \r\n" +
        $buffer = preg_replace('/AQerT/', '\\\\n', $buffer);   // Restore \n"
        $buffer = preg_replace('/BQerT/', '\\\\r', $buffer);   // Restore \r"
        $buffer = preg_replace("/ZUQQ/", "/ /", $buffer);
        $buffer = preg_replace('/\s\/\*Zu\*\/\s/', '', $buffer);   // Restore \n"
        $buffer = preg_replace('/\s\/\*Yu\*\/\s/', '', $buffer);   // Restore \n"
        ////---------------------------------------------------------------------------------------------------------
        //// Remove all markings!
        $buffer = preg_replace('/(AwTc)/', '', $buffer);  // Start most Regex!
        $buffer = preg_replace('/(CwRc)/', '', $buffer);  // End Most regex!
        // all \s and [\n\r] repair like they where!
        $buffer = preg_replace("/([a-zA-Z0-9]\s?)\s*[\n\r]+(\s*[\)\,&]\s?)(\s*[\r\n]+\s*[\{])/", "$1$2$3", $buffer);
        $buffer = preg_replace("/([a-zA-Z0-9\(]\s?)\s*[\n\r]+(\s*[;\)\,&\+\-a-zA-Z0-9]\s?)(\s*[\{;a-zA-Z0-9\,&\n\r])/", "$1$2$3", $buffer);
        $buffer = preg_replace("/(\(\s?)\s*[\n\r]+(\s*function)/", "$1$2", $buffer);
        $buffer = preg_replace("/(=\s*\[[a-zA-Z0-9]\s?)\s*([\r\n]+)/", "$1", $buffer);
        //-----------------------------------------------
        $buffer = preg_replace("/([^\*\/\'\"]\s*)(\/\/\s*\*\/)/", "$1", $buffer);
        //// Remove all /**/// .... Remove expept /**/ and followed by */ till newline!
        $buffer = preg_replace("/(\/\*\*\/)(\/\/(?!([^\n\r]*?\*\/)).*)/", "$1", $buffer);
        $buffer = preg_replace("/(\;\/\*\*\/)(?!([^\n\r]*?\*\/)).*/", "", $buffer);
        $buffer = preg_replace("/(\/\/\\\\\*[^\n\r\"\'\/]*?[\n\r])/", "\r\n", $buffer);
        $buffer = preg_replace("/([\r\n]\s*)(\/\*[^\r\n]*?\*\/(?!([^\r\n]*?\"\s*\+)))/", "$1", $buffer);
        //Remove colon /**/
        $buffer = preg_replace("/\/\*\*\/\s/", " ", $buffer);
        $buffer = preg_replace("/(\=\s*)(?=([^\r\n\'\"]*?\'[^\n\r\'\"]*?\'))([^\n\r\/]*?)(\/\/[^\r\n\"\'][^\r\n]*[\'\"])(\/\*\*\/)[\n\r]/", "$1$3$4\n", $buffer);
        $buffer = preg_replace("/(\=\s*)(?=([^\r\n\'\"]*?\"[^\n\r\'\"]*?\"))([^\n\r\/]*?)(\/\/[^\r\n\"\'][^\r\n]*[\'\"])(\/\*\*\/)[\n\r]/", "$1$3$4\n", $buffer);
        //Remove colon //
        $buffer = preg_replace("/([^\'\"ps\s]\s*)(\:[^\r\n\'\"\[\]]*?\'[^\n\r\'\"]*?\')([^\n\r\/a-zA-Z0-9]*?)(\/\/)[^\r\n\/\'][^\r\n]*/", "$1$2", $buffer);
        $buffer = preg_replace("/([^\'\"ps\s]\s*)(\:[^\r\n\'\"\[\]]*?\"[^\n\r\'\"]*?\")([^\n\r\/a-zA-Z0-9]*?)(\/\/)[^\r\n\/\"][^\r\n]*/", "$1$2", $buffer);
        $buffer = preg_replace("/(\"[^\n\r\'\"\+]*?\")([^\n\r\/a-zA-Z0-9]*?)(\/\/)(?!(\*|[^\r\n]*?[\\\\n\\\\r]+\s*\"\s*\+|[^\r\n]*?[\\\\n\\\\r]+\s*\'\s*\+))[^\r\n\/\"][^\r\n]*/", "$1$2", $buffer);
        //Remove all after ; slah slah+
        $buffer = preg_replace("/(;\s*)\/\/(?!([^\n\r]*?\"\s*;)).*/", "$1 \n", $buffer);
        //Remove: ) /* non-empty*//*xxx*/)
        $buffer = preg_replace('/([\n\r][^\n\r\"]*?)([^\/\"\'\*\>])\/\*(?!(\*\/))[^\n\r\"]*?[^@]\*\//', "$1$2", $buffer);
        //Remove // vooraf gegaan door: || | ? | , //
        $buffer = preg_replace("/(\|\||[\?]|\,)(\s*)\/\/(?!([^\n\r]*?\*\/|\"|\')).*/", "$1$2", $buffer);
        //Remove: [\n\r] after: [ \|\[\;\,\:\=\-\{\}\]\[\?\)\( ]
        $buffer = preg_replace("/([\|\[\;\,\:\=\-\{\}\]\[\?\)\(])\s*[\n\r]\s*[\n\r](\s*[\n\r])+/", "$1\n", $buffer);
        ////---------------------------------------------------------------------------------------------------------
        //END Remove comments.    //START Remove all whitespaces
        $buffer = preg_replace('/(--\s+\>)/', 'HwRc', $buffer);  // protect space between: -- >
        //--------------------------------------------------------
        $buffer = preg_replace('/\s+/', ' ', $buffer);
        $buffer = preg_replace('/\s*(?:(?=[=\-\+\|%&\*\)\[\]\{\};:\,\.\<\>\!\@\#\^`~]))/', '', $buffer);
        $buffer = preg_replace('/(?:(?<=[=\-\+\|%&\*\)\[\]\{\};:\,\.\<\>\?\!\@\#\^`~]))\s*/', '', $buffer);
        $buffer = preg_replace('/([^a-zA-Z0-9\s\-=+\|!@#$%^&*()`~\[\]{};:\'",<.>\/?])\s+([^a-zA-Z0-9\s\-=+\|!@#$%^&*()`~\[\]{};:\'",<.>\/?])/', '$1$2', $buffer);
        //-------------------------------------------------------
        $buffer = preg_replace('/(HwRc)/', '-- >', $buffer);  // Repair space between: -- >
        //END Remove all whitespaces

        return $buffer;
    }

    public static function minify_css( $buffer ) {
        if( trim( $buffer ) === "") return $buffer;

        // Remove comments
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

        // Remove whitespace
        $buffer = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $buffer);

        // Remove space after colons
        $buffer = str_replace(': ', ':', $buffer);

        // Remove space near commas
        $buffer = str_replace(', ', ',', $buffer);
        $buffer = str_replace(' ,', ',', $buffer);

        // Remove space near brackets
        $buffer = str_replace('{ ', '{', $buffer);
        $buffer = str_replace('} ', '}', $buffer);
        $buffer = str_replace(' {', '{', $buffer);
        $buffer = str_replace(' }', '}', $buffer);

        // Remove last dot with comma
        $buffer = str_replace(';}', '}', $buffer);

        return $buffer;
    }

}
