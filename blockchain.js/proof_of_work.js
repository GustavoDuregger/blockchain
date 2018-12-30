//para executar:
//   $ npm install        -- or npm install -g js-sha256
//   $ node ./blockchain_with_proof_of_work.js


const SHA256 = require( "js-sha256" )     // for hash checksum digest function SHA256


class Block {

  constructor(index, data, previousHash) {
    this.index             = index
    this.timestamp         = new Date()
    this.data              = data
    this.previousHash      = previousHash
    this.nonce, this.hash  = this.computeHashWithProofOfWork()
  }

  computeHashWithProofOfWork( difficulty="00" ) {
    var nonce = 0
    while( true ) {
      var hash = this.calcHashWithNonce( nonce )
      if( hash.startsWith( difficulty ))
        return nonce, hash    
      else
        nonce += 1           
    }
  }

  calcHashWithNonce( nonce=0 ) {
    var sha = SHA256.create()
    sha.update( nonce.toString() + this.index.toString() + this.timestamp.toString() + this.data + this.previousHash )
    return sha.hex()
  }


  static first( data="Genesis" ) {    
 
    return new Block( 0, data, "0" )
  }

  static next( previous, data="Transaction Data..." ) {
    return new Block( previous.index+1, data, previous.hash )
  }
}




b0 = Block.first( "Genesis" )
b1 = Block.next( b0, "Transaction Data..." )
b2 = Block.next( b1, "Transaction Data......" )
b3 = Block.next( b2, "More Transaction Data..." )


blockchain = [b0, b1, b2, b3]

console.log( blockchain )


