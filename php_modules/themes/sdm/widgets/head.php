<?php 
$abstract = "Facts4Me is an online reference tool for primary readers of English. This site is written by teachers and is committed to offering high-quality, educationally-sound information in an ad-free, child-safe environment.";
$this->theme->add( $this->url. 'assets/css/factsstyles.css', '', 'factsstyles');
$this->theme->add( $this->url. 'assets/css/styles.css', '', 'styles');
$this->theme->add( $this->url. 'assets/css/bootstrap.css', '', 'bootstrap');
$this->theme->add( $this->url. 'assets/js/jquery-3.6.0.min.js', '', 'jquery-3.6.0.min');
$this->theme->add( $this->url. 'assets/js/bootstrap.bundle.min.js', '', 'bootstrap');



?>
<META name="verify-v1" content="MjjEVcfc+4AlZMy4hC0hMAsi0HJQF9dcydjLOP0QLvM=" />
<title>Welcome to Facts 4 Me</title>
<meta name="description" content="<?php echo  $abstract?>">
<meta name="abstract" content="<?php echo  $abstract?>">
<meta name="keywords" content="Facts 4 Me, Facts for Me, Factsforme">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="reply-to" content="joe@borschedigital.com">
<meta http-equiv="Content-Language" content="en-us">

<meta name="author" content="Joseph Borsche of Borsche Digital">
<meta name="MSSmartTagsPreventParsing" content="TRUE">
<meta name="classification" content="Freelance Services">
<meta name="copyright" content="Copyright � 1999-2006 Joseph Borsche, All Rights Reserved">
<meta name="distribution" content="Global">
<meta name="doc-type" content="Web Page">
<meta name="doc-rights" content="Copywritten Work">
<meta name="doc-class" content="Completed">
<meta name="expires" content="Wed, 09 Aug 2004 08:21:57 GMT">    <!-- a date in the past to disable caching of the document -->
<meta name="language" content="English">
<meta name="publisher" content="Joseph Borsche of Borsche Digital">
<meta name="rating" content="Safe for Kids">     <!-- General=PG  Safe for Kids=G  -->
<meta name="resource-type" content="document">
<meta name="revisit-after" content="15 days">
<meta name="robots" content="ALL">
<meta name="googlebot" content="ALL">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
    var d=document; 
    if(d.images) { 
        if(!d.MM_p) d.MM_p=new Array();
        var i,j=d.MM_p.length,a=MM_preloadImages.arguments; 
        for(i=0; i<a.length; i++)
            if (a[i].indexOf("#")!=0){ 
                d.MM_p[j]=new Image; 
                d.MM_p[j++].src=a[i];
            }
    }
}

function MM_findObj(n, d) { //v4.01
    var p,i,x;  
    if(!d) d=document; 
    if((p=n.indexOf("?"))>0&&parent.frames.length) {
        d=parent.frames[n.substring(p+1)].document; 
        n=n.substring(0,p);
    }
    if(!(x=d[n])&&d.all) x=d.all[n]; 
    for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
    for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
    if(!x && d.getElementById) x=d.getElementById(n); 
    return x;
}

function MM_nbGroup(event, grpName) 
{ //v6.0
    var i,img,nbArr,args=MM_nbGroup.arguments;
    if (event == "init" && args.length > 2) {
        if ((img = MM_findObj(args[2])) != null && !img.MM_init) {
            img.MM_init = true; img.MM_up = args[3]; img.MM_dn = img.src;
            if ((nbArr = document[grpName]) == null) nbArr = document[grpName] = new Array();
            nbArr[nbArr.length] = img;
            for (i=4; i < args.length-1; i+=2) 
                if ((img = MM_findObj(args[i])) != null) {
                    if (!img.MM_up) img.MM_up = img.src;
                    img.src = img.MM_dn = args[i+1];
                    nbArr[nbArr.length] = img;
                } 
        }
    } else if (event == "over") {
        document.MM_nbOver = nbArr = new Array();
        for (i=1; i < args.length-1; i+=3) 
            if ((img = MM_findObj(args[i])) != null) {
                if (!img.MM_up) img.MM_up = img.src;
                img.src = (img.MM_dn && args[i+2]) ? args[i+2] : ((args[i+1])? args[i+1] : img.MM_up);
                nbArr[nbArr.length] = img;
        }
    } else if (event == "out" ) {
        for (i=0; i < document.MM_nbOver.length; i++) {
            img = document.MM_nbOver[i]; img.src = (img.MM_dn) ? img.MM_dn : img.MM_up; }
    } else if (event == "down") {
        nbArr = document[grpName];
        if (nbArr)
        for (i=0; i < nbArr.length; i++) { 
            img=nbArr[i]; 
            img.src = img.MM_up; 
            img.MM_dn = 0; 
        }
        document[grpName] = nbArr = new Array();
        for (i=2; i < args.length-1; i+=2) 
            if ((img = MM_findObj(args[i])) != null) {
                if (!img.MM_up) img.MM_up = img.src;
                img.src = img.MM_dn = (args[i+1])? args[i+1] : img.MM_up;
                nbArr[nbArr.length] = img;
            } 
    }
}

</script>