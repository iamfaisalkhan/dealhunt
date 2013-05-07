from scrapy.spider import BaseSpider
from scrapy.selector import HtmlXPathSelector

from dlzbot.items import Deal

import sys

class Deals2BuySpider(BaseSpider):
   
   name = "deals2buy"
   allowed_domains = ["Deals2Buy.com"]
   start_urls = [
      "http://www.deals2buy.com/"
   ]

   def parse(self, response):
      hxs = HtmlXPathSelector(response)
      title = hxs.select('//title/text()')
      # The deals are grouped into list blocks with right and left elements
      # The left block is for the price information and right block is
      # for the detail titles. 
      # Below, we select all the list items on the page. 
      sites = hxs.select('//li[normalize-space(@class)="detail_view"]')
      print " Len of deals " , len(sites)

      items = []

      d = ""

      try:
         d = title.re('([0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2})')[0]
      except:
         from datetime import datetime
         d = datetime.now().strftime("%Y-%m-%d")

      for site in sites:
         item = Deal()

         # Now, from each list block, get the `
         # Extract deal title, continue in case of exception, or empty title.  
         try:
            title_block = site.select('.//div[@class="offer_title"]')
            t = title_block.select('.//a/span/text()').extract()[0].strip()
            if (len(t) == 0):
               continue
            item['title'] = t
            item['date'] = d
         except: 
            continue

         # Extract other possible attributes about the deal, ignore in case of exception
         try:
            item['source'] = title_block.select('h2/span/text()').extract()[0].strip()
            exp = title_block.select('div[@class="expires"]/span/text()').extract()[0].strip()
            # Modify the date format equivalent to mysql date format 
            tmp = exp.split("/")
            item['expires'] = "%s-%s-%s"%(tmp[2], tmp[0], tmp[1]) 
            item['price'] = title_block.select('.//strong[@class="yourprice"]/text()').extract()[0].strip()
            # List price is little different, we obtin it from the main block 
            item['list_price'] = site.select('.//dd[@class="listprice"]/del/text()') .extract()[0].strip()
         except:
            print "Failure to process deals2buy item ", sys.exc_info()[0]

         items.append(item)

      return items 
