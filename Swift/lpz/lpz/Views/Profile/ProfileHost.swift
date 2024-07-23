//
//  ProfileHost.swift
//  lpz
//
//  Created by Jose Antonio Lopez Lopez on 5/7/23.
//

import SwiftUI

struct ProfileHost: View {
    
    @Environment(\.editMode) var editMode
    @EnvironmentObject var modelData: ModelData
    @State private var profile: Profile = Profile.default

    var body: some View {
        VStack(alignment: .leading, spacing: 10){
            HStack{
                if editMode?.wrappedValue == .active {
                    Button("Cancel", role: .cancel){
                        profile = modelData.profile
                        editMode?.animation().wrappedValue = .inactive
                    }
                }
                Spacer()
                EditButton()
            }
            if editMode?.wrappedValue ==  .inactive{
                ProfileSummary(profile: modelData.profile)
            }else{
                ProfileEditor(profile: $profile)
                    .onAppear {
                        profile = modelData.profile
                    }
                    .onDisappear{
                        modelData.profile = profile
                    }
            }
            
        }
        .padding()
    }
}

struct ProfileHost_Previews: PreviewProvider {
    static var previews: some View {
        ProfileHost()
            .environmentObject(ModelData())
    }
}
