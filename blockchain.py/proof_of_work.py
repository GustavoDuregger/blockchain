import hashlib as hasher
import datetime as date
import pprint


class Block:
  def __init__( self, index, data, previous_hash ):
    self.index              = index
    self.timestamp          = date.datetime.now()
    self.data               = data
    self.previous_hash      = previous_hash
    self.nonce, self.hash   = self.compute_hash_with_proof_of_work()

  def compute_hash_with_proof_of_work( self, difficulty="00" ):
    nonce = 0
    while True:    
      hash = self.calc_hash_with_nonce( nonce )
      if hash.startswith( difficulty ):
        return [nonce,hash]  
      else:
        nonce += 1            

  def calc_hash_with_nonce( self, nonce=0 ):
    sha = hasher.sha256()
    sha.update(str(nonce).encode("utf-8") +
               str(self.index).encode("utf-8") +
               str(self.timestamp).encode("utf-8") +
               str(self.data).encode("utf-8") +
               str(self.previous_hash).encode("utf-8"))
    return sha.hexdigest()


  def __repr__( self ):
        return "Block<\n  index: {},\n  timestamp: {},\n  data: {},\n  previous_hash: {},\n  nonce: {},\n  hash: {}>".format(
          self.index, self.timestamp, self.data, self.previous_hash, self.nonce, self.hash)


  @staticmethod
  def first( data="Genesis" ):
    return Block( 0, data, "0" )

  @staticmethod
  def next( previous, data="Transaction Data..." ):
    return Block( previous.index+1, data, previous.hash )





b0 = Block.first( "Genesis" )
b1 = Block.next( b0, "Transaction Data..." )
b2 = Block.next( b1, "Transaction Data......" )
b3 = Block.next( b2, "More Transaction Data..." )


blockchain = [b0, b1, b2, b3]

pprint.pprint( blockchain )
