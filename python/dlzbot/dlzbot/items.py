# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/topics/items.html

from scrapy.item import Item, Field

class Deal(Item):
    # define the fields for your item here like:
    source_id = Field()
    title = Field()
    date = Field()
    source = Field()
    expires = Field()
    price = Field()
    list_price = Field()
    deal_url = Field()
    source_url = Field()
    image = Field()

