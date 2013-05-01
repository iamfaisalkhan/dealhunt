from scrapy.spider import BaseSpider
from scrapy.selector import HtmlXPathSelector

from dlzbot.items import Deal

import json

class eightcouponsSpider(BaseSpider):
   
   name = "8coupons"
   allowed_domains = ["8coupons.com"]
   # TODO Remove the api key from the code. 
   api_key = '1de19c6e2f7bf4ec46cb84b76b455d64c07c197a2462cf4640645f68d2b1b6a7b02801cc53a728a5f4e7e8616ad3cace'
   start_urls = [
      "http://api.8coupons.com/v1/getrealtimechaindeals?key=" + api_key
   ]

   def parse(self, response):
      items = []
      rs = json.loads(response.body)
      for r in rs:
         # Ignore the individual deal or part of the deal
         #  using try/except block 
         try:
            item = Deal()
            item['title']      = r['dealTitle']
            item['source_id']  = r['ID']
            item['source']     = r['dealSource']
            item['expires']    = r['expirationDate']
            item['date']       = r['postDate']
            item['deal_url']        = r['URL']
            item['source_url']        = r['storeURL']
            items
         except:
            import sys
            print "Failure to process 8coupons ", sys.exc_info()[0]

         items.append(item)  

      return items   

