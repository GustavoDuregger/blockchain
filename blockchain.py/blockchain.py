

import hashlib as hasher
import datetime as date
import pprint


class Block:
  def __init__( self, index, data, previous_hash ):
    self.index         = index
    self.timestamp     = date.datetime.now()
    self.data          = data
    self.previous_hash = previous_hash
    self.hash          = self.calc_hash()

  def calc_hash( self ):
    sha = hasher.sha256()
    sha.update(str(self.index).encode("utf-8") +
               str(self.timestamp).encode("utf-8") +
               str(self.data).encode("utf-8") +
               str(self.previous_hash).encode("utf-8"))
    return sha.hexdigest()

  def __repr__( self ):
        return "Block<\n  index: {},\n  timestamp: {},\n  data: {},\n  previous_hash: {},\n  hash: {}>".format(
          self.index, self.timestamp, self.data, self.previous_hash, self.hash)


  @staticmethod
  def first( data="Genesis" ):
    return Block( 0, data, "0" )

  @staticmethod
  def next( previous, data="Transaction Data..." ):
    return Block( previous.index + 1, data, previous.hash )





b0 = Block.first( "Genesis" )
b1 = Block.next( b0, "Transaction Data..." )
b2 = Block.next( b1, "Transaction Data......" )
b3 = Block.next( b2, "More Transaction Data..." )


blockchain = [b0, b1, b2, b3]

pprint.pprint( blockchain )

