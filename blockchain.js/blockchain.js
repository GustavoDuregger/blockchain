

const SHA256 = require( "js-sha256" )    


class Block {

  constructor(index, data, previousHash) {
    this.index        = index
    this.timestamp    = new Date()
    this.data         = data
    this.previousHash = previousHash
    this.hash         = this.calcHash()
  }

  calcHash() {
    var sha = SHA256.create()
    sha.update( this.index.toString() + this.timestamp.toString() + this.data + this.previousHash )
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

