#!/usr/bin/perl
#----------------------------------------------------------------------
# CHEditor perl Library
#
#   Author  : Chang Ho Na
#   Email   : chna@chcode.com
#
#======================================================================

use CGI;
use AttachFile;
use strict ref;

    my $in = new CGI();
    my ($tmpl, $filename, $output, $upload_director, $upload_url, %NAMESPACE, $upload);

    $editor_path = "/usr/local/apache/htdocs/cheditor";
    $editor_url = "http://www.chcode.com/cheditor";


    $tmpl = "$editor_path/insert_image.html";

    if ($in->param('AttachFile')) {
        my $attach = AttachFile->new($in->param('AttachFile'));

        $filename = $attach->orig_filename;
        $filename =~ s/.*\.(.+)$/$1/;
        $filename = time() . '_' . $$ . '.' . $filename;
        $attach->save_as("$editor_path/attach/$filename");

        %NAMESPACE = (
            IMAGESRC => "$editor_url/attach/$filename",
            IMAGEWIDTH => $in->param('imageWidth'),
            IMAGEHEIGHT => $in->param('imageHeight'),
        );

        $NAMESPACE{IMAGEALT} = $in->param('description') if $in->param('description');
        $NAMESPACE{IMAGEALIGN} = $in->param('alignment') if $in->param('alignment');
        $NAMESPACE{IMAGEBORDER} = $in->param('b') if $in->param('b');
        $NAMESPACE{IMAGEVSPACE} = $in->param('v') if $in->param('v');
        $NAMESPACE{IMAGEHSPACE} = $in->param('h') if $in->param('h');

        $upload++;
    }


    open (TPL, $tmpl);
    {
        local($/) = undef;
        $output = <TPL>;
    }
    close (TPL);

    $output =~ s/\$([A-Z]+)/$NAMESPACE{$1}/g;

    print "Content-Type: text/html\n\n";
    print $output;

    if ($upload) {
        print qq~<script>DoReturn();</script>~;
    }
