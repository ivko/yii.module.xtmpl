<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet [
    <!ENTITY % HTMLsymbol PUBLIC
    "-//W3C//ENTITIES Symbols for XHTML//EN"
    "../_shared/xhtml-symbol.ent">
    <!ENTITY % HTMLspecial PUBLIC
    "-//W3C//ENTITIES Special for XHTML//EN"
    "../_shared/xhtml-special.ent">
    <!ENTITY % HTMLlat1 PUBLIC
    "-//W3C//ENTITIES Special for XHTML//EN"
    "../_shared/xhtml-lat1.ent">
      %HTMLspecial;
      %HTMLlat1;
      %HTMLsymbol;
    ]>
<xsl:stylesheet version="1.0"
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
        xmlns:php="http://php.net/xsl"
        xmlns:fo="http://www.w3.org/1999/XSL/Format"
        exclude-result-prefixes="php fo">
    <xsl:output
        doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN"
        method="xml"
        indent="yes"
        encoding="utf-8"
        doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"
        omit-xml-declaration="yes"
    />
    <!--xsl:include href="navigation.xsl"/-->
    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="bg" lang="bg">
            <head>
                <title>
                    <xsl:value-of select="/root/site_config/sitename"/>
                </title>
            </head>
            <body>
                <div class="container">
                    <xsl:value-of select="/root/content" disable-output-escaping="yes" />
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>