//
//  pepe.swift
//  lpz
//
//  Created by Jose Antonio Lopez Lopez on 22/6/23.
//

import SwiftUI

struct ImageView: View {
    var image: Image
    
    var body: some View {
        image.clipShape(Circle())
            .overlay(){
                Circle().stroke(.white, lineWidth: 5)
            }
            .shadow(radius: 7)
    }
}

struct ImageView_Previews: PreviewProvider {
    static var previews: some View {
        ImageView(image: ModelData().landmarks[0].image)
    }
}

