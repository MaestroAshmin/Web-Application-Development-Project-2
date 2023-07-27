<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html"/> 
<xsl:template match="/">
  <html>
  <body>
    <h2>Shipping Catalog</h2>
    <table border="1">
      <tr bgcolor="grey">
        <th>Item Number</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Add</th>
      </tr>
      <xsl:for-each select="items/item[item_qty &gt; 0]">
      <tr>
        <td id="item_number"><xsl:value-of select="item_number" /></td>
        <xsl:variable name="item_id" select="item_number" />
        <td id="item_name"><xsl:value-of select="item_name" /></td>
        <td id="text_description"><xsl:value-of select="substring(item_description/text(),1,10)"/></td>
        <td id="item_price"><xsl:value-of select="item_price"/></td>
        <td id="item_qty"><xsl:value-of select="item_qty"/></td>
        <td id="select_button"><button onclick="addToCart('Add');">Add one to the cart</button></td>
      </tr>
      </xsl:for-each>
    </table>
<br />
  </body>
  </html>
</xsl:template>
</xsl:stylesheet>