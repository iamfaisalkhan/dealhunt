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
      sites = hxs.select('//div[@class="offer_title"]')

      items = []

      d = ""

      try:
         d = title.re('([0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2})')[0]
      except:
         from datetime import datetime
         d = datetime.now().strftime("%Y-%m-%d")

      for site in sites:
         item = Deal()

         # Extract deal title, continue in case of exception, or empty title.  
         try:
            t = site.select('.//a/span/text()').extract()[0].strip()
            if (len(t) == 0):
               continue
            item['title'] = t
            item['date'] = d
         except: 
            continue

         # Extract other possible attributes about the deal, ignore in case of exception
         try:
            item['source'] = site.select('h2/span/text()').extract()[0].strip()
            item['expires'] = site.select('div[@class="expires"]/span/text()').extract()[0].strip()
            item['price'] = site.select('.//strong[@class="yourprice"]/text()').extract()[0].strip()
         except:
            print "Failure to process deals2buy item ", sys.exc_info()[0]

         items.append(item)

      return items 
